<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/database/database_connection.php";

function get_dashboard_messages() {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM dashboard_messages");
	$stmt->execute([]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}