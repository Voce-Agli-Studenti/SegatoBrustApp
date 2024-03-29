<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/database/database_connection.php";

/**
 * Aggiunge un nuovo utente
 *
 * @param integer $id ID di Moodle dell'utente
 * @param string $first_name Nome dell'utente
 * @param string $last_name Cognome dell'utente
 * @param string $email Email dell'utente
 * @param string $class_id ID della classe
 * @param boolean $is_admin Indica se l'utente è admin o no
 */
function add_user($id, $first_name, $last_name, $email, $avatar_url, $class_id, $is_admin) {
	$pdo = pdo_connection();

	$user_id = hash_hmac("sha256", $id, "user_id");

	$stmt = $pdo->prepare("INSERT INTO users VALUES(:user_id, :first_name, :last_name, :email, :avatar_url, :class_id, :is_admin, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 0)");
	$stmt->execute([
		'user_id' => $user_id,
		'first_name' => $first_name, 
		'last_name' => $last_name, 
		'email' => $email,
		'avatar_url' => $avatar_url,
		'class_id' => $class_id,
		'is_admin' => intval($is_admin),
	]);
}

/**
 * Modifica un utente
 *
 * @param integer $id ID di Moodle dell'utente
 * @param string $first_name Nome dell'utente
 * @param string $last_name Cognome dell'utente
 * @param string $email Email dell'utente
 * @param string $class_id ID della classe
 */
function edit_user($user_id, $first_name, $last_name, $email, $avatar_url, $class_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("UPDATE users SET first_name=:first_name, last_name=:last_name, email=:email, avatar_url=:avatar_url, class_id=:class_id WHERE user_id=:user_id");
	$stmt->execute([
		'first_name' => $first_name, 
		'last_name' => $last_name, 
		'email' => $email, 
		'avatar_url' => $avatar_url, 
		'class_id' => $class_id, 
		'user_id' => $user_id,
	]);
}

/**
 * Aggiorna lo stato di un utente
 * 
 * @param string $user_id ID dell'utente
 * 
 * @return void
 */
function update_user_status($user_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("UPDATE users SET last_active=CURRENT_TIMESTAMP WHERE user_id=:user_id");
	$stmt->execute(['user_id' => $user_id]);
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
