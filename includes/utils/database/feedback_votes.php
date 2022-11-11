<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/database/database_connection.php";

function get_feedback_votes($feedback_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT SUM(vote) as total FROM feedback_votes WHERE feedback_id=:feedback_id");
	$stmt->execute(['feedback_id' => $feedback_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * Ottiene un voto dato da un utente ad un feedback
 *
 * @param string $user_id ID dell'utente
 * @param string $feedback_id ID del feedback
 *
 * @return array Risultato della query
 */
function get_feedback_vote($user_id, $feedback_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM feedback_votes WHERE user_id=:user_id AND feedback_id=:feedback_id");
	$stmt->execute(['user_id' => $user_id, 'feedback_id' => $feedback_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * Aggiunge/cambia un voto di un utente ad un feedback
 *
 * @param string $user_id ID dell'utente
 * @param string $feedback_id ID del feedback
 * @param int $vote Voto
 *
 * @return void
 */
function cast_feedback_vote($user_id, $feedback_id, $vote) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("INSERT INTO feedback_votes VALUES(:user_id, :feedback_id, :vote_1, CURRENT_TIMESTAMP) ON DUPLICATE KEY UPDATE vote=:vote_2");
	$stmt->execute([
		'user_id' => $user_id,
		'feedback_id' => $feedback_id,
		'vote_1' => $vote,
		'vote_2' => $vote,
	]);
}

/**
 * Aggiunge/cambia un voto di un utente ad un feedback
 *
 * @param string $user_id ID dell'utente
 * @param string $feedback_id ID del feedback
 *
 * @return void
 */
function delete_feedback_vote($user_id, $feedback_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("DELETE FROM feedback_votes WHERE user_id=:user_id AND feedback_id=:feedback_id");
	$stmt->execute(['user_id' => $user_id, 'feedback_id' => $feedback_id]);
}