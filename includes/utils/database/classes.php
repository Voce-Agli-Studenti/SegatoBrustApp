<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/database/database_connection.php";

/**
 * Ottiene una classe dato il suo moodle_category_id
 * 
 * @param string $moodle_category_id ID della categoria moodle della classe
 * 
 * @return array Risultati della query
 */
function get_class_by_moodle_category_id($moodle_category_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM classes WHERE moodle_category_id=:moodle_category_id");
	$stmt->execute(['moodle_category_id' => $moodle_category_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * Controlla se una classe esiste dato il suo moodle_category_id
 * 
 * @param string $moodle_category_id ID della categoria moodle della classe
 * 
 * @return boolean True se la classe esiste, false se non esiste
 */
function class_exists_by_moodle_category_id($moodle_category_id) {
	return !empty(get_class_by_moodle_category_id($moodle_category_id));
}