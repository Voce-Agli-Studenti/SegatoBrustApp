<?php
ob_implicit_flush(true);
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/commons.php";
require_once "includes/utils/database/users.php";

session_set_cookie_params(2592000, "/", "", true, false);
//error_reporting(0);
session_name("session_id");
session_start();
setlocale(LC_ALL, "it_IT.UTF-8");

function destroy_session() {
	session_unset();
	session_destroy();
	header("Location: /");
	die();
}

if (isset($_SESSION['user_id'])) {
	$user_id = $_SESSION['user_id'];
	
	if (user_exists_by_id($user_id)) {
		$user = get_user_by_id($user_id)[0];

		if ($user['disabled'] == 0) {
			define("USER_IS_LOGGED", true);
			define("USER", $user);
		} else {
			define("USER_IS_LOGGED", false);
		}
	} else {
		define("USER_IS_LOGGED", false);
	}
	
} else {
	define("USER_IS_LOGGED", false);
}


if (!USER_IS_LOGGED && defined("LOGIN_REQUIRED") && LOGIN_REQUIRED) {
	redirect("/login/");
}