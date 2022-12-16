<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/database/database_connection.php";

/**
 * Ottiene la somma di tutti i voti di un commento
 * 
 * @param string $feedback_comment_id ID del commento
 * 
 * @return array Ritorna la somma dei voti del commento
 */
function get_feedback_comment_votes($feedback_comment_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT SUM(vote) as total FROM feedback_comment_votes WHERE feedback_comment_id=:feedback_comment_id");
	$stmt->execute(['feedback_comment_id' => $feedback_comment_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * Ottiene il voto di un utente dato ad un commento
 * 
 * @param string $user_id ID dell'utente
 * @param string $feedback_comment_id ID del commento
 */
function get_feedback_comment_vote($user_id, $feedback_comment_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM feedback_comment_votes WHERE user_id=:user_id AND feedback_comment_id=:feedback_comment_id");
	$stmt->execute(['user_id' => $user_id, 'feedback_comment_id' => $feedback_comment_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * Aggiunge/cambia un voto di un utente ad un commento
 *
 * @param string $user_id ID dell'utente
 * @param string $feedback_comment_id ID del commento
 * @param int $vote Voto
 *
 * @return void
 */
function cast_feedback_comment_vote($user_id, $feedback_comment_id, $vote) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("INSERT INTO feedback_comment_votes VALUES(:user_id, :feedback_comment_id, :vote_1, CURRENT_TIMESTAMP) ON DUPLICATE KEY UPDATE vote=:vote_2");
	$stmt->execute([
		'user_id' => $user_id,
		'feedback_comment_id' => $feedback_comment_id,
		'vote_1' => $vote,
		'vote_2' => $vote,
	]);
}

/**
 * Elimina il voto di un utente ad un commento
 *
 * @param string $user_id ID dell'utente
 * @param string $feedback_comment_id ID del commento
 *
 * @return void
 */
function delete_feedback_comment_vote($user_id, $feedback_comment_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("DELETE FROM feedback_comment_votes WHERE user_id=:user_id AND feedback_comment_id=:feedback_comment_id");
	$stmt->execute(['user_id' => $user_id, 'feedback_comment_id' => $feedback_comment_id]);
}