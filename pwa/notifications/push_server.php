<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
define("LOGIN_REQUIRED", true);

require_once "includes/utils/session.php";
require_once "includes/utils/database/notification_subscribers.php";

$subscription = json_decode(file_get_contents('php://input'), true);

if (!isset($subscription['endpoint'])) {
	echo 'Error: not a subscription';
	return;
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
case 'POST':
	// create a new subscription entry in your database (endpoint is unique)
	add_notification_subscription(USER['user_id'], $subscription['endpoint'], $subscription['publicKey'], $subscription['authToken'], $subscription['contentEncoding']);
	break;
case 'PUT':
	edit_notification_subscription($subscription['endpoint'], $subscription['publicKey'], $subscription['authToken']);
	break;
case 'DELETE':
	delete_notification_subscription($subscription['endpoint']);
	break;
default:
	echo "Error: method not handled";
	return;
}