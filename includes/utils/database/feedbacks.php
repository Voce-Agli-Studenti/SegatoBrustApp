<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/database/database_connection.php";

/**
 * Aggiunge un nuovo feedback
 *
 * @param string $user_id ID dell'utente
 * @param string $title Titolo del feedback
 * @param string $description Descrizione del feedback
 * @param boolean $is_anonymous Indica se il feedback è anonimo
 *
 * @return string|boolean In caso di successo ritorna il feedback_id, altrimenti ritorna false
 */
function add_feedback($user_id, $title, $description, $is_anonymous) {
	$pdo = pdo_connection();

	$feedback_id = hash_hmac("sha256", uniqid(), "feedback_id");

	$stmt = $pdo->prepare("INSERT INTO feedbacks VALUES(
		:feedback_id,
		:user_id,
		:title,
		:description,
		:is_anonymous,
		CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 0
		)");

	$stmt->execute([
		'feedback_id' => $feedback_id,
		'user_id' => $user_id,
		'title' => $title,
		'description' => $description,
		'is_anonymous' => intval($is_anonymous),
	]);

	return feedback_exists_by_id($feedback_id) ? $feedback_id : false;
}

/**
 * Modifica un feedback
 * 
 * @param string $feedback_id ID del feedback da modificare
 * @param string $title Titolo del feedback
 * @param string $description Descrizione del feedback
 * @param string $is_anonymous Indica se il feedback è anonimo
 */
function edit_feedback($feedback_id, $title, $description, $is_anonymous) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("UPDATE feedbacks SET 
		title=:title,
		description=:description,
		is_anonymous=:is_anonymous WHERE feedback_id=:feedback_id");

	$stmt->execute([
		'feedback_id' => $feedback_id,
		'title' => $title,
		'description' => $description,
		'is_anonymous' => intval($is_anonymous),
	]);
}


/**
 * Ottiene un feedback dato il suo feedback_id
 *
 * @param string $feedback_id ID del feedback
 *
 * @param array Risultato della query
 */
function get_feedback_by_id($feedback_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM feedbacks WHERE feedback_id=:feedback_id AND is_deleted=0");
	$stmt->execute(['feedback_id' => $feedback_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}


/**
 * Ottiene tutti i dettagli di un feedback
 * 
 * @param string $feedback_id ID del feedback
 * 
 * @return array Risultato della query
 */
function get_feedback_full_by_id($feedback_id) {
	$pdo = pdo_connection();
	$pdo->setAttribute(PDO::ATTR_FETCH_TABLE_NAMES, true);

	$stmt = $pdo->prepare("SELECT * FROM feedbacks 
	INNER JOIN users ON feedbacks.user_id=users.user_id
	WHERE feedback_id=:feedback_id AND is_deleted=0");
	
	$stmt->execute(['feedback_id' => $feedback_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * Ottiene tutti i dettagli di tutti i feedback
 * 
 * @return array Risultato della query
 */
function get_feedbacks_full() {
	$pdo = pdo_connection();
	$pdo->setAttribute(PDO::ATTR_FETCH_TABLE_NAMES, true);

	$stmt = $pdo->prepare("SELECT 
	feedbacks.*,
	users.*,
	(SELECT SUM(vote) FROM feedback_votes WHERE feedback_id=feedbacks.feedback_id) as votes 
	FROM feedbacks 
	INNER JOIN users ON feedbacks.user_id=users.user_id
	WHERE is_deleted=0 ORDER BY votes DESC, creation_date DESC");
	
	$stmt->execute([]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * Controlla se un feedback esiste dato il suo feedback_id
 *
 * @param string $feedback_id ID del feedback
 *
 * @return boolean True se il feedback esiste, false se non esiste
 */
function feedback_exists_by_id($feedback_id) {
	return !empty(get_feedback_by_id($feedback_id));
}