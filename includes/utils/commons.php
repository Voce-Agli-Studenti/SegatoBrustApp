<?php

set_include_path($_SERVER['DOCUMENT_ROOT']);

function httpPostRequest($url, $data) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: multipart/form-data']);
	$result = curl_exec($ch);
	return $result;
}

function redirect($url) {
	header("Location: " . $url);

	die();
}