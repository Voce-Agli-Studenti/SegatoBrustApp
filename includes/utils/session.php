<?php
ob_implicit_flush(true);
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/commons.php";

session_set_cookie_params(2592000, "/", "", true, true);
//error_reporting(0);
session_name("GLOBAL_USER_ID");
session_start();
setlocale(LC_ALL, "it_IT.UTF-8");

function destroy_session() {
	session_unset();
	session_destroy();
	header("Location: /");
	die();
}

if (isset($_SESSION['user_id'])) {
	
} else {

}