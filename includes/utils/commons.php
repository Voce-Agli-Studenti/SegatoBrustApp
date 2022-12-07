<?php

set_include_path($_SERVER['DOCUMENT_ROOT']);

/**
 * Divide un URL ad ogni '/' e ritorna un array con tutti i componenti dell'URL
 *
 * @param string $url L'URL da dividere
 * @param string $base_path
 * @param string $query_string Query string to remove
 *
 * @return array Array con i componenti dell'url
 */
function split_url($url, $base_path, $query_string = "") {

	if (!empty($query_string)) {
		$query_string = "?" . $query_string;
		$url = substr($url, 0, -strlen($query_string));
	}

	$pos = strpos($url, $base_path);
	if ($pos !== false) {
		$url = substr_replace($url, "", $pos, strlen($base_path));
	}

	$request_uri_elements = explode("/", $url);

	$final_uri_elements = [];

	for ($i = 0; $i < count($request_uri_elements); $i++) {
		if (!empty($request_uri_elements[$i])) {
			$final_uri_elements[] = $request_uri_elements[$i];
		}
	}

	return $final_uri_elements;
}

function http_post_request($url, $data) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	curl_setopt($ch, CURLOPT_HTTPHEADER, [
		'Content-Type: multipart/form-data',
		'User-agent: MoodleMobile'
	]);
	$result = curl_exec($ch);
	return $result;
}

function redirect($url) {
	header("Location: " . $url);

	die();
}

function get_user_id($id) {
	return hash_hmac("sha256", $id, "user_id");
}

/**
 * Converte una timestamp in una durata
 *
 * @param string $datetime Data da convertire
 * @param boolean $full Se true la durata verrà indicata per esteso
 *
 */
function time_elapsed_string($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = [
		'y' => 'anno',
		'm' => 'mese',
		'w' => 'settimana',
		'd' => 'giorno',
		'h' => 'ora',
		'i' => 'minuto',
		's' => 'secondo',
	];

	$strings = [
		'y' => 'anni',
		'm' => 'mesi',
		'w' => 'settimane',
		'd' => 'giorni',
		'h' => 'ore',
		'i' => 'minuti',
		's' => 'secondi',
	];

	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			if ($diff->$k > 1) {
				$string[$k] = $diff->$k . ' ' . $strings[$k];
			} else {
				$v = $diff->$k . ' ' . $v;
			}

		} else {
			unset($string[$k]);
		}
	}

	if (!$full) {
		$string = array_slice($string, 0, 1);
	}

	return $string ? implode(', ', $string) . ' fa' : 'adesso';
}

function ucname($string) {
	$string = ucwords(strtolower($string));

	foreach (array('-', '\'') as $delimiter) {
		if (strpos($string, $delimiter) !== false) {
			$string = implode($delimiter, array_map('ucfirst', explode($delimiter, $string)));
		}
	}
	
	return $string;
}