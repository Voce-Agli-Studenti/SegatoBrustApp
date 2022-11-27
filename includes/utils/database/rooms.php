<?php

/**
 * Ottiene un'aula dato il suo room_id
 *
 * @param string $room_id ID dell'aula
 *
 * @param array Risultato della query
 */
function get_room_by_id($room_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM rooms WHERE room_id=:room_id");
	$stmt->execute(['room_id' => $room_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * Controlla se un'aula esiste dato il suo room_id
 *
 * @param string $room_id ID dell'aula
 *
 * @return boolean True se l'aula esiste, false se non esiste
 */
function room_exists_by_id($room_id) {
	return !empty(get_room_by_id($room_id));
}

/**
 * Aggiunge una nuova aula
 *
 * @param string $room_code Codice dell'aula
 * @param string $name Nome dell'aula
 * @param string $school Sede della scuola. 0=Segato, 1=Brustolon
 *
 * @return string|boolean In caso di successo ritorna il room_id, altrimenti ritorna false
 */
function add_room($room_code, $name, $school) {
	$pdo = pdo_connection();

	$room_id = hash("sha256", $room_code);

	$stmt = $pdo->prepare("INSERT INTO rooms VALUES(
		:room_id,
		:room_code,
		:name,
		)");

	$stmt->execute([
		'room_id' => $room_id,
		'room_code' => $room_code,
		'name' => $name,
		'school' => $school,
	]);

	return room_exists_by_id($room_id) ? $room_id : false;
}