<?php

set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/session.php";
require_once "includes/utils/commons.php";
require_once "includes/utils/database/feedback_medias.php";

$parts = split_url($_SERVER['REQUEST_URI'], "/media/feedbacks/");

if (isset($parts[0])) {
	$media = get_feedback_media_by_id($parts[0]);

	if (!empty($media)) {
		header("Content-type: " . $media[0]['mime_type']);
		die($media[0]['media']);
	}
}

http_response_code(404);
die();