<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/database/database_connection.php";

/**
 * Aggiunge un nuovo utente
 *
 * @param integer $id ID di Moodle dell'utente
 * @param string $name Nome dell'utente
 * @param string $email Email dell'utente
 */
function add_user($id, $name, $email, $avatar_url) {
	$pdo = pdo_connection();

	$user_id = hash_hmac("sha256", $id, "user_id");

	$stmt = $pdo->prepare("INSERT INTO users VALUES(:user_id, :name, :email, :avatar_url, 0)");
	$stmt->execute(['user_id' => $user_id, 'name' => $name, 'email' => $email, 'avatar_url' => $avatar_url]);
}

/**
 * Modifica un utente
 *
 * @param integer $id ID di Moodle dell'utente
 * @param string $name Nome dell'utente
 * @param string $email Email dell'utente
 */
function edit_user($user_id, $name, $email, $avatar_url) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("UPDATE users SET name=:name, email=:email, avatar_url=:avatar_url WHERE user_id=:user_id");
	$stmt->execute(['name' => $name, 'email' => $email, 'avatar_url' => $avatar_url, 'user_id' => $user_id]);
}

/**
 * Ottiene le informazioni di un utente dato il suo user_id
 *
 * @param string $user_id ID dell'utente
 *
 * @param array Risultato della query
 */
function get_user_by_id($user_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(['user_id' => $user_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * Controlla se un utente esiste dato il suo user_id
 *
 * @param string $user_id ID dell'utente
 *
 * @return boolean True se l'utente esiste, false se l'utent non esiste
 */
function user_exists_by_id($user_id) {
	return !empty(get_user_by_id($user_id));
}
