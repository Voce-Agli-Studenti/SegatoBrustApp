<?php

/**
 * Ottiene un professore dato il suo professor_id
 *
 * @param string $professor_id ID del professore
 *
 * @param array Risultato della query
 */
function get_professor_by_id($professor_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM professors WHERE professor_id=:professor_id");
	$stmt->execute(['professor_id' => $professor_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * Controlla se un professore esiste dato il suo professor_id
 *
 * @param string $professor_id ID del professore
 *
 * @return boolean True se il professore esiste, false se non esiste
 */
function professor_exists_by_id($professor_id) {
	return !empty(get_professor_by_id($professor_id));
}

/**
 * Aggiunge un nuovo professore
 *
 * @param string $first_name Cognome del professore
 * @param string $last_name Cognome del professore
 *
 * @return string|boolean In caso di successo ritorna il professor_id, altrimenti ritorna false
 */
function add_professor($first_name, $last_name) {
	$pdo = pdo_connection();

	$professor_id = hash("sha256", $first_name . $last_name);

	$stmt = $pdo->prepare("INSERT INTO professors VALUES(
		:professor_id,
		:first_name,
		:last_name,
		)");

	$stmt->execute([
		'professor_id' => $professor_id,
		'first_name' => $first_name,
		'last_name' => $last_name,
	]);

	return professor_exists_by_id($professor_id) ? $professor_id : false;
}