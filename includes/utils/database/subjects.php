<?php

/**
 * Ottiene una materia dato il suo subject_id
 *
 * @param string $subject_id ID della materia
 *
 * @param array Risultato della query
 */
function get_subject_by_id($subject_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM subjects WHERE subject_id=:subject_id");
	$stmt->execute(['subject_id' => $subject_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * Controlla se una materia esiste dato il suo subject_id
 *
 * @param string $subject_id ID della materia
 *
 * @return boolean True se la materia esiste, false se non esiste
 */
function subject_exists_by_id($subject_id) {
	return !empty(get_subject_by_id($subject_id));
}

/**
 * Aggiunge una nuova materia
 *
 * @param string $subject_code Codice della materia
 * @param string $name Nome della materia
 *
 * @return string|boolean In caso di successo ritorna il subject_id, altrimenti ritorna false
 */
function add_subject($subject_code, $name) {
	$pdo = pdo_connection();

	$subject_id = hash("sha256", $subject_code);

	$stmt = $pdo->prepare("INSERT INTO subjects VALUES(
		:subject_id,
		:subject_code,
		:name,
		)");

	$stmt->execute([
		'subject_id' => $subject_id,
		'subject_code' => $subject_code,
		'name' => $name,
	]);

	return subject_exists_by_id($subject_id) ? $subject_id : false;
}