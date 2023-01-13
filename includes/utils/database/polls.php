<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/database/database_connection.php";

/**
 * Ottiene un sondaggio dato il suo poll_id
 * 
 * @param string $poll_id ID del sondaggio
 * 
 * @return array Ritorna i risultati della query
 */
function get_poll_by_id($poll_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM polls WHERE poll_id=:poll_id");
	$stmt->execute(['poll_id' => $poll_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * Controlla se un sondaggio esiste dato il suo poll_id
 * 
 * @param string $poll_id ID del sondaggio
 * 
 * @return boolean True se il sondaggio esiste, false se non esiste
 */
function poll_exists_by_id($poll_id) {
	return !empty(get_poll_by_id($poll_id));
}

/**
 * Ottiene tutti i sondaggi
 * 
 * @return array Ritorna i risultati della query
 */
function get_polls() {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM polls ORDER BY creation_date");
	$stmt->execute([]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}