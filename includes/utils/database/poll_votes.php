<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/database/database_connection.php";

/**
 * Ottiene la somma di tutti i voti di un sondaggio
 *
 * @param string $poll_id ID del sondaggio
 * 
 * @return array Ritorna i risultati della query
 */
function get_poll_total_votes_count($poll_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT COUNT(*) AS total_votes FROM poll_votes WHERE poll_id = :poll_id");
	$stmt->execute(['poll_id' => $poll_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * Ottiene il numero di voti di un'opzione di un sondaggio
 * 
 * @param string $poll_id ID del sondaggio
 * @param integer $option Numero dell'opzione del sondaggio
 */
function get_poll_votes_count($poll_id, $option) {
	$pdo = pdo_connection();
	error_log($poll_id);

	$stmt = $pdo->prepare("SELECT
	(SELECT COUNT(*) FROM poll_votes WHERE vote = :vote AND poll_id = :poll_id) AS vote_count,
	COUNT(vote) AS total_votes
FROM
	poll_votes
WHERE poll_id = :poll_id1");
	$stmt->execute(['poll_id1' => $poll_id, 'poll_id' => $poll_id, 'vote' => $option]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}



/**
 * Ottiene un voto dato da un utente ad un sondaggio
 *
 * @param string $user_id ID dell'utente
 * @param string $poll_id ID del sondaggio
 *
 * @return array Risultato della query
 */
function get_poll_vote($user_id, $poll_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM poll_votes WHERE user_id=:user_id AND poll_id=:poll_id");
	$stmt->execute(['user_id' => $user_id, 'poll_id' => $poll_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * Aggiunge/cambia un voto di un utente ad un sondaggio
 *
 * @param string $user_id ID dell'utente
 * @param string $poll_id ID del sondaggio
 * @param int $vote Voto
 *
 * @return void
 */
function cast_poll_vote($user_id, $poll_id, $vote) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("INSERT INTO poll_votes VALUES(:user_id, :poll_id, :vote_1, CURRENT_TIMESTAMP) ON DUPLICATE KEY UPDATE vote=:vote_2");
	$stmt->execute([
		'user_id' => $user_id,
		'poll_id' => $poll_id,
		'vote_1' => $vote,
		'vote_2' => $vote,
	]);
}

/**
 * Elimina il voto di un utente ad un sondaggio
 *
 * @param string $user_id ID dell'utente
 * @param string $poll_id ID del sondaggio
 *
 * @return void
 */
function delete_poll_vote($user_id, $poll_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("DELETE FROM poll_votes WHERE user_id=:user_id AND poll_id=:poll_id");
	$stmt->execute(['user_id' => $user_id, 'poll_id' => $poll_id]);
}

