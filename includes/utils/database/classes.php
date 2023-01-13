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
 * Ottiene una classe dato il suo class_id
 * 
 * @param string $class_id ID della classe
 * 
 * @return array Risultati della query
 */
function get_class_by_id($class_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM classes WHERE class_id=:class_id");
	$stmt->execute(['class_id' => $class_id]);
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

/**
 * Ottiene una classe dato il suo nome
 * 
 * @param string $name Nome della classe
 * 
 * @return array Risultati della query
 */
function get_class_by_name($name) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM classes WHERE name=:name");
	$stmt->execute(['name' => $name]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}