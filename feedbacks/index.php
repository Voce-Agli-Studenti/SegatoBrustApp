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
	$category = "school";
	require "feedbacks/feedback_list.php";
	
} else if ($parts_count == 1 || $parts_count == 2) {
	
	if ($parts[0] == "app") {
		 $category = "app";
		 require "feedbacks/feedback_list.php";
		 
		} elseif ($parts[0] == "school") {
		$category = "school";
		require "feedbacks/feedback_list.php";
		
	} elseif ($parts[0] == "ideas") {
		$category = "ideas";
		require "feedbacks/feedback_list.php";
		
	} else if ($parts[0] == "add") {

		if (!USER_IS_LOGGED) {
			redirect("/login/");
		}

		require "feedbacks/add_feedback.php";

	} else {

		$feedback_id = $parts[0];

		if (!feedback_exists_by_id($feedback_id)) {
			redirect("/feedbacks/");
		}

		$feedback = get_feedback_by_id($feedback_id)[0];

		// Controlla se l'utente ha il permesso di modificare il feedback
		$user_can_edit_feedback = (USER_IS_LOGGED && (hash_equals($feedback['user_id'], USER['user_id']) || USER['is_admin']));

		$action = $parts[1] ?? "";

		if ($action == "edit") {

			if (!$user_can_edit_feedback) {
				// L'utente non è loggato o non è il proprietario del feedback e non è un admin
				redirect("/feedbacks/" . $feedback_id);
			}

			require "feedbacks/edit_feedback.php";
		} else {
			require "feedbacks/feedback.php";
		}
	}

}