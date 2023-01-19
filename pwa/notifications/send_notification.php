<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/database/notification_subscribers.php";
require "vendor/autoload.php";

use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;


$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['key'])) {
	die(json_encode(["error" => "missing_key"]));
}

$key = $data['key'];
$stored_key = trim(file_get_contents("/var/keys/feedback.segato.iacca.ml/authKey.pem"));
if ($key !== $stored_key) {
	die(json_encode(["error" => "invalid_key"]));
}

unset($data['key']);

$auth = array(
	'VAPID' => array(
		'subject' => 'giosue@iacca.ml',
		'publicKey' => "BEcxUNEtDr8Tbz6ahGB3rYMqRs41s9fwkkkijEmc3JgRAcjODL_rEWHtiw0hLJOKG_HRozlTiuXao_uF3hNX_2c",
		'privateKey' => file_get_contents("/var/keys/feedback.segato.iacca.ml/pushKey.pem"),
	),
);

$subscriptions = get_notification_subscriptions();

for ($i = 0; $i < count($subscriptions); $i++) {

	$subscription_data = [
		'endpoint' => $subscriptions[$i]['endpoint'],
		'publicKey' => $subscriptions[$i]['public_key'],
		'authToken' => $subscriptions[$i]['auth_token'],
	];

	$defaultOptions = [
		'TTL' => 300,
		'urgency' => $data['urgency'] ?? "normal",
		'topic' => $data['topic'] ?? "new_event",
		'batchSize' => 200,
	];

	$subscription = Subscription::create($subscription_data);
	$webPush = new WebPush($auth);

	$notification_data = [
		'title' => $data['notification']['title'] ?? "",
		'options' => $data['notification']['options'] ?? []
	];

	$report = $webPush->sendOneNotification(
		$subscription,
		json_encode($notification_data),
		$defaultOptions
	);

	$endpoint = $report->getRequest()->getUri()->__toString();

	if ($report->isSuccess()) {
		
	} else {
		$report = json_decode(json_encode($report), true);

		if ($report['expired']) {
			delete_notification_subscription($report['endpoint']);
		}
	}
}