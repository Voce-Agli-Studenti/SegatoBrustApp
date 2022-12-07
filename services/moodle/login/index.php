<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/session.php";
require_once "includes/utils/commons.php";
require_once "includes/utils/moodle_api.php";

if (USER_IS_LOGGED) {
	$wstoken = $_COOKIE['moodle_token'];
	$private_token = $_COOKIE['moodle_private_token'];

	$user_data = moodle_get_site_info($wstoken);

	if (isset($user_data['userid'])) {

		$autologin_data = moodle_autologin($wstoken, $private_token);

		if (isset($autologin_data['key'])) {
			$query = [
				'userid' => $user_data['userid'],
				'key' => $autologin_data['key'],
			];

			$login_url = $autologin_data['autologinurl'] . "?" . http_build_query($query);
			setcookie("moodle_autologin_key", $autologin_data['key'], time() + 60 * 60 * 24 * 7 * 12, "/", "", true, false);

		} elseif (isset($_COOKIE['moodle_autologin_key']) && !empty($_COOKIE['moodle_autologin_key'])) {
			$query = [
				'userid' => $user_data['userid'],
				'key' => $_COOKIE['moodle_autologin_key'],
			];

			$login_url = "https://moodle.segatobrustolon.edu.it/admin/tool/mobile/autologin.php?" . http_build_query($query);
		}
	}
}