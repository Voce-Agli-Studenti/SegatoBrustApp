<?php

/**
 * Ottiene un'attività dato il suo time_schedule_id
 *
 * @param string $time_schedule_id ID dell'attività
 *
 * @param array Risultato della query
 */
function get_time_schedule_by_id($time_schedule_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM time_schedules WHERE time_schedule_id=:time_schedule_id");
	$stmt->execute(['time_schedule_id' => $time_schedule_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * Controlla se un'attività esiste dato il suo time_schedule_id
 *
 * @param string $time_schedule_id ID dell'attività
 *
 * @return boolean True se l'attività esiste, false se non esiste
 */
function time_schedule_exists_by_id($time_schedule_id) {
	return !empty(get_time_schedule_by_id($time_schedule_id));
}

/**
 * Aggiunge una nuova attività
 *
 * @param string $class_id ID della classe
 * @param string $room_id ID dell'aula
 * @param string $lab_room_id ID dell'aula di laboratorio
 * @param string $subject ID della materia
 *
 * @return string|boolean In caso di successo ritorna il time_schedule_id, altrimenti ritorna false
 */
function add_time_schedule($time_schedule_code, $name) {
	$pdo = pdo_connection();

	$time_schedule_id = hash("sha256", $time_schedule_code);

	$stmt = $pdo->prepare("INSERT INTO time_schedules VALUES(
		:time_schedule_id,
		:time_schedule_code,
		:name,
		)");

	$stmt->execute([
		'time_schedule_id' => $time_schedule_id,
		'name' => $name,
	]);

	return subject_exists_by_id($time_schedule_id) ? $time_schedule_id : false;
}