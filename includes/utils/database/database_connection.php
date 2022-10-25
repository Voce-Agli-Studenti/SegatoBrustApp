<?php

set_include_path($_SERVER['DOCUMENT_ROOT']);

$pdo = new PDO("mysql:host=localhost;dbname=scuola", "", "");
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
$pdo->query('set profiling=0');

function pdo_connection() {
	global $pdo;
	$pdo->setAttribute(PDO::ATTR_FETCH_TABLE_NAMES, false);
	return $pdo;
}


function show_database_profiling() {
	$pdo = pdo_connection();
	$stmt = $pdo->query('show profiles');
	header("Content-type: application/json");
	die(json_encode($stmt->fetchAll(PDO::FETCH_ASSOC)));
}