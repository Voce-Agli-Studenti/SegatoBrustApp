<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
//define("LOGIN_REQUIRED", true);
define("ROUTER_REQUIRED", true);

require_once "includes/utils/session.php";
require_once "includes/utils/commons.php";
require_once "includes/utils/database/polls.php";

$parts = split_url($_SERVER['REQUEST_URI'], "/polls/", $_SERVER['QUERY_STRING'] ?? "");

$parts_count = count($parts);

if ($parts_count == 0) {
	$category = "school";
	require "polls/poll_list.php";

} else if ($parts_count == 1) {

	$poll_id = $parts[0];

	if (!poll_exists_by_id($poll_id)) {
		redirect("/polls/");
	}

	$poll = get_poll_by_id($poll_id)[0];

	require "polls/poll.php";
}