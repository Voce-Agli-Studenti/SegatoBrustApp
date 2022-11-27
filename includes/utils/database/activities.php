<?php

/**
 * Ottiene un'attività dato il suo activity_id
 *
 * @param string $activity_id ID dell'attività
 *
 * @param array Risultato della query
 */
function get_activity_by_id($activity_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM activities WHERE activity_id=:activity_id");
	$stmt->execute(['activity_id' => $activity_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * Controlla se un'attività esiste dato il suo activity_id
 *
 * @param string $activity_id ID dell'acttività
 *
 * @return boolean True se l'attività esiste, false se non esiste
 */
function activity_exists_by_id($activity_id) {
	return !empty(get_activity_by_id($activity_id));
}

/**
 * Aggiunge una nuova attività
 *
 * @param string $class_id Codice della classe
 * @param string $room Aula
 * @param string $subject Materia
 * @param string $professor Professori
 * @param int $day Giorno
 * @param int $hour Ora
 *
 * @return string|boolean In caso di successo ritorna il activity_id, altrimenti ritorna false
 */
function add_activity($class_id, $room, $subject, $professors, $day, $hour) {
	$pdo = pdo_connection();

	$activity_id = hash_hmac("sha256", uniqid(), "activity_id");

	$stmt = $pdo->prepare("INSERT INTO activities VALUES(
		:activity_id,
		:class_id,
		:room,
		:subject,
		:professors,
		:day,
		:hour
		)");

	$stmt->execute([
		'activity_id' => $activity_id,
		'class_id' => $class_id,
		'room' => $room,
		'subject' => $subject,
		'professors' => $professors,
		'day' => $day,
		'hour' => $hour,
	]);

	return activity_exists_by_id($activity_id) ? $activity_id : false;
}