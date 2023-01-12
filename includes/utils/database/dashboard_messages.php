<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/database/database_connection.php";

/**
 * Ottiene tutti i messaggi appartenenti ad una specifica categoria
 * 
 * @param string $category Categoria del messaggio
 */
function get_dashboard_messages_by_category($category) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM dashboard_messages WHERE category=:category ORDER BY creation_date DESC");
	$stmt->execute(['category' => $category]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}