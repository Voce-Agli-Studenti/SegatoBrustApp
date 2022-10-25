<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

function moodleLogin($username, $password) {
	$data = [
		'username' => $username,
		'password' => $password,
		'service' => "moodle_mobile_app"
	];
	
	$response = httpPostRequest("https://moodle.segatobrustolon.edu.it/login/token.php", $data);

	if (isset($response['errorcode']) && $response['error'] == "errorcode") {
		return false;
	}

	if (isset($response['token'])) {
		setcookie("moodle_token", $response['token'], time() + 60*60*24*365, "/", "", true, true);
		return true;
	}
}

function getUserInfo($username) {
	
	$data = [
		"wstoken" => "8b55546c1d66ac47b14391a5cfd76858",
		"wsfunction" => "core_user_update_users",
		"moodlewsrestformat" => "json",
		"field" => "username",
		"values" => [
			$username
		]
	];
	
	httpPostRequest("https://moodle.segatobrustolon.edu.it/webservice/rest/server.php", $data);
}