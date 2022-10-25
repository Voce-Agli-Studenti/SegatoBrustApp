<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

include "includes/utils/database/users.php";


function add_user($id, $name, $email) {
	$pdo = pdo_connection();

	$user_id = hash_hmac("sha256", $id, "user_id");	

	$stmt = $pdo->prepare("INSERT INTO users VALUES(:user_id, :name, :email, 0)");
	$stmt->execute(['user_id' => $user_id, 'name' => $name, 'email' => $email]);
}