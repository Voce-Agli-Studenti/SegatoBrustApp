<?php
set_include_path("/var/www/feedback.segato.iacca.ml");

require_once "includes/utils/database/database_connection.php";
require_once "includes/utils/database/classes.php";
require_once "includes/utils/database/activities.php";

$file = fopen('data/EXP_COURS.csv', 'r');

/*
NUMERO;NOME;DURATA;FREQUENZA;MAT_COD;MAT_NOME;DOC_COGN;DOC_NOME;CLASSE;AULA;PERIODICITÀ;SPECIFICA;CO-DOC.;COEFF.;GIORNO;O.INIZIO;SEDE;ALUNNI
 */

$hour_mapping = [
	"08h00" => 0,
	"09h00" => 1,
	"10h00" => 2,
	"11h00" => 3,
	"12h00" => 4,
	"13h00" => 5,
];

$day_mapping = [
	"lunedì" => 0,
	"martedì" => 1,
	"mercoledì" => 2,
	"giovedì" => 3,
	"venerdì" => 4,
	"sabato" => 5,
];

while (($l = fgetcsv($file, 0, ";")) !== FALSE) {
	
	$hour_span = $l[2];

	$subject_code = $l[4];
	$subject_name = $l[5];

	if ($subject_code == "-") {
		continue;
	}
	
	$professor_last_names = ucwords(strtolower($l[6]));
	$professor_first_names = ucwords(strtolower($l[7]));
	
	$class_names = $l[8];
	$room_names = $l[9];

	$day_string = $l[14];
	$hour_string = $l[15];

	if ($day_string == "") {
		continue;
	}


	$classes = explode(",", $class_names);
	//$rooms = explode(",", $room_names);

	foreach ($classes as $class) {
		
		$class = trim($class);

		$class_id = get_class_by_name($class)[0]['class_id'] ?? null;

		if (!$class_id) {
			die($class . " not found");
		}

		$day = $day_mapping[$day_string];
		$hour = $hour_mapping[$hour_string];

		echo json_encode($l) . PHP_EOL;
		if ($hour_span == "1h00") {
			add_activity($class_id, $room_names, $subject_name, $professor_last_names, $day, $hour);
		} else if ($hour_span == "2h00") {
			add_activity($class_id, $room_names, $subject_name, $professor_last_names, $day, $hour);
			add_activity($class_id, $room_names, $subject_name, $professor_last_names, $day, $hour + 1);
		}

	}
}

fclose($file);