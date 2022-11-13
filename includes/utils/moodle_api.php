<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

function moodle_login($username, $password) {
	$data = [
		'username' => $username,
		'password' => $password,
		'service' => "moodle_mobile_app"
	];
	
	$response = http_post_request("https://moodle.segatobrustolon.edu.it/login/token.php", $data);
	$response = json_decode($response, true);

	if (isset($response['errorcode']) && $response['errorcode'] == "invalidlogin") {
		return false;
	}

	if (isset($response['token'])) {
		return $response;
	}
}

function moodle_get_user_info($wstoken, $username) {
	
	$data = [
		"wstoken" => $wstoken,
		"wsfunction" => "core_user_get_users_by_field",
		"moodlewsrestformat" => "json",
		"field" => "username",
		"values[0]" => $username
	];
	
	$response = http_post_request("https://moodle.segatobrustolon.edu.it/webservice/rest/server.php", $data);
	$response = json_decode($response, true);
	return $response;
}


function moodle_get_user_courses($wstoken, $moodle_user_id) {
	$data = [
		"wstoken" => $wstoken,
		"wsfunction" => "core_enrol_get_users_courses",
		"moodlewsrestformat" => "json",
		"userid" => $moodle_user_id,
	];
	
	$response = http_post_request("https://moodle.segatobrustolon.edu.it/webservice/rest/server.php", $data);
	$response = json_decode($response, true);
	return $response;
}