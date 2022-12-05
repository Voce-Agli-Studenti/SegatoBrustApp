<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/database/database_connection.php";

/**
 * Ottiene tutti i commenti di un feedback
 * 
 * @param string $feedback_id ID del feedback
 * 
 * @param array Risultato della query
 */
function get_feedback_comments_full($feedback_id) {
	$pdo = pdo_connection();
	$pdo->setAttribute(PDO::ATTR_FETCH_TABLE_NAMES, true);

	$stmt = $pdo->prepare("SELECT * FROM feedback_comments 
	INNER JOIN users ON feedback_comments.user_id=users.user_id 
	WHERE feedback_comments.feedback_id=:feedback_id
	ORDER BY feedback_comments.creation_date DESC");
	$stmt->execute(['feedback_id' => $feedback_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}


/**
 * Aggiunge un nuovo commento ad un feedback
 * 
 * @param string $feedback_id ID del feedback
 * @param string $user_id ID dell'utente
 * @param string $text Testo del commento
 * 
 * @return string|boolean In caso di successo ritorna il feedback_id, altrimenti ritorna false
 */
function add_feedback_comment($feedback_id, $user_id, $text) {
	$pdo = pdo_connection();

	$feedback_comment_id = hash_hmac("sha256", uniqid(), "feedback_comment_id");

	$stmt = $pdo->prepare("INSERT INTO feedback_comments VALUES(
		:feedback_comment_id,
		:feedback_id,
		:user_id,
		:text,
		CURRENT_TIMESTAMP, 0)");

	$stmt->execute([
		'feedback_comment_id' => $feedback_comment_id,
		'feedback_id' => $feedback_id,
		'user_id' => $user_id,
		'text' => $text,
	]);

	return feedback_comment_exists_by_id($feedback_comment_id) ? $feedback_comment_id : false;
}


/**
 * Ottiene un commento di un feedback dato il suo feedback_comment_id
 *
 * @param string $feedback_comment_id ID del commento
 *
 * @param array Risultato della query
 */
function get_feedback_comment_by_id($feedback_comment_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM feedback_comments WHERE feedback_comment_id=:feedback_comment_id AND is_deleted=0");
	$stmt->execute(['feedback_comment_id' => $feedback_comment_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}


/**
 * Controlla se un commento di un feedback esiste dato il suo feedback_comment_id
 *
 * @param string $feedback_comment_id ID del commento
 *
 * @return boolean True se il commento esiste, false se non esiste
 */
function feedback_comment_exists_by_id($feedback_comment_id) {
	return !empty(get_feedback_comment_by_id($feedback_comment_id));
}
