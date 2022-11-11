<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/database/database_connection.php";

/**
 * Aggiunge un nuovo endpoint per le notifiche
 *
 * @param string $user_id ID univoco dell'utente
 * @param string $endpoint Endpoint per l'invio delle notifiche
 * @param string $public_key Chiave pubblica
 * @param string $auth_token Token
 * @param string $content_encoding Content encoding
 */
function add_notification_subscription($user_id, $endpoint, $public_key, $auth_token, $content_encoding) {
	$pdo = pdo_connection();

	$notification_subscription_id = hash_hmac("sha256", $endpoint, "notification_subscription_id");

	$stmt = $pdo->prepare("INSERT INTO notification_subscriptions VALUES(
		:notification_subscription_id,
		:user_id,
		:endpoint,
		:public_key,
		:auth_token,
		:content_encoding
		)");

	$stmt->execute([
		'notification_subscription_id' => $notification_subscription_id,
		'user_id' => $user_id,
		'endpoint' => $endpoint,
		'public_key' => $public_key,
		'auth_token' => $auth_token,
		'content_encoding' => $content_encoding,
	]);
}

/**
 * Modifica un endpoint di una notifica
 *
 * @param string $endpoint Endpoint per l'invio delle notifiche
 * @param string $public_key Chiave pubblica
 * @param string $auth_token Token
 */
function edit_notification_subscription($endpoint, $public_key, $auth_token) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("UPDATE notification_subscriptions SET
		public_key=:public_key,
		auth_token=:auth_token
		WHERE endpoint=:endpoint
		");

	$stmt->execute([
		'endpoint' => $endpoint,
		'public_key' => $public_key,
		'auth_token' => $auth_token,
	]);
}

/**
 * Elimina un endpoint per le notifiche
 *
 * @param string $endpoint Endpoint da eliminare
 */
function delete_notification_subscription($endpoint) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("DELETE FROM notification_subscriptions WHERE endpoint=:endpoint");

	$stmt->execute(['endpoint' => $endpoint]);
}

/**
 * Ritorna tutti gli endpoint per le notifiche
 */
function get_notification_subscriptions() {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM notification_subscriptions");

	$stmt->execute([]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}