<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
//define("LOGIN_REQUIRED", true);
define("ROUTER_REQUIRED", true);

require_once "includes/utils/session.php";
require_once "includes/utils/commons.php";
require_once "includes/utils/database/feedbacks.php";

$parts = split_url($_SERVER['REQUEST_URI'], "/feedbacks/", $_SERVER['QUERY_STRING'] ?? "");

$parts_count = count($parts);

if ($parts_count == 0) {
	require "feedbacks/feedback_list.php";

} else if ($parts_count == 1) {
	$feedback_id = $parts[0];

	if (feedback_exists_by_id($feedback_id)) {
		require "feedbacks/feedback.php";
	} else {
		redirect("/feedbacks/");
	}
}