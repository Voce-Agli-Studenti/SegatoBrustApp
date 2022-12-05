<?php
set_include_path("/var/www/feedback.segato.iacca.ml");

require_once "includes/utils/database/database_connection.php";
require_once "includes/utils/database/users.php";
require_once "includes/utils/commons.php";

$pdo = pdo_connection();

$stmt = $pdo->prepare("SELECT * FROM users");
$stmt->execute([]);
$users = $stmt->fetchAll(\PDO::FETCH_ASSOC);

for ($i=0; $i < count($users); $i++) { 
	edit_user($users[$i]['user_id'], ucname(strtolower($users[$i]['name'])), $users[$i]['email'], $users[$i]['avatar_url'], $users[$i]['class_id']);
}