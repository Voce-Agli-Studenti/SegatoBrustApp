<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/database/database_connection.php";

/**
 * Aggiunge un nuovo media di un feedback
 * 
 * @param string $feedback_if ID del feedback
 * @param blob $media Media
 * @param string $mime_type Mime type del media
 *
 * @return string|boolean In caso di successo ritorna il feedback_media_id, altrimenti ritorna false
 */
function add_feedback_media($feedback_id, $media, $mime_type) {
	$pdo = pdo_connection();

	$feedback_media_id = hash_hmac("sha256", uniqid(), "feedback_media_id");

	$stmt = $pdo->prepare("INSERT INTO feedback_medias VALUES(
		:feedback_media_id,
		:feedback_id,
		:media,
		:mime_type,
		CURRENT_TIMESTAMP)");

	$stmt->execute([
		'feedback_media_id' => $feedback_media_id,
		'feedback_id' => $feedback_id,
		'media' => $media,
		'mime_type' => $mime_type
	]);

	return feedback_media_exists_by_id($feedback_media_id) ? $feedback_media_id : false;
}

/**
 * ottiene un media dato il suo feedback_media_id
 *
 * @param string $feedback_media_id ID del media
 *
 * @param array Risultato della query
 */
function get_feedback_media_by_id($feedback_media_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM feedback_medias WHERE feedback_media_id=:feedback_media_id");
	$stmt->execute(['feedback_media_id' => $feedback_media_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

/**
 * Controlla se un media di un feedback esiste dato il suo feedback_media_id
 *
 * @param string $feedback_media_id ID del media
 *
 * @return boolean True se il media esiste, false se non esiste
 */
function feedback_media_exists_by_id($feedback_media_id) {
	return !empty(get_feedback_media_by_id($feedback_media_id));
}

/**
 * Ottiene tutte le immagini di un feedback
 * 
 * @param string $feedback_id ID del feedback
 * 
 * @return array Risultato della query
 */
function get_feedback_medias($feedback_id) {
	$pdo = pdo_connection();

	$stmt = $pdo->prepare("SELECT * FROM feedback_medias WHERE feedback_id=:feedback_id");
	$stmt->execute(['feedback_id' => $feedback_id]);
	return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
