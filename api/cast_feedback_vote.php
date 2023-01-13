<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/session.php";
require_once "includes/utils/commons.php";
require_once "includes/utils/database/feedbacks.php";
require_once "includes/utils/database/feedback_votes.php";


header("Content-type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!USER_IS_LOGGED) {
	$json = ['ok' => false, 'error_code' => 403, 'description' => "Forbidden: login required"];
	http_response_code(403);
	die(json_encode($json));
}

if (!isset($data['feedback_id']) || empty($data['feedback_id'])) {
	$json = ['ok' => false, 'error_code' => 400, 'description' => "Bad Request: feedback_id is required"];
	http_response_code(400);
	die(json_encode($json));
}

if (!isset($data['vote']) || empty($data['vote'])) {
	$json = ['ok' => false, 'error_code' => 400, 'description' => "Bad Request: vote is required"];
	http_response_code(400);
	die(json_encode($json));
}

if (!feedback_exists_by_id($data['feedback_id'])) {
	$json = ['ok' => false, 'error_code' => 404, 'description' => "Bad Request: feedback not found"];
	http_response_code(404);
	die(json_encode($json));
}

$feedback_id = $data['feedback_id'];
$vote = intval($data['vote']);

if ($vote != 1 && $vote != -1) {
	$json = ['ok' => false, 'error_code' => 400, 'description' => "Bad Request: invalid value for vote"];
	http_response_code(400);
	die(json_encode($json));
}

$user_feedback_vote = get_feedback_vote(USER['user_id'], $feedback_id);

if (empty($user_feedback_vote)) {
	cast_feedback_vote(USER['user_id'], $feedback_id, $vote);
} else {
	$user_feedback_vote = $user_feedback_vote[0];

	if ($user_feedback_vote['vote'] == $vote) {
		delete_feedback_vote(USER['user_id'], $feedback_id);
	} else {
		cast_feedback_vote(USER['user_id'], $feedback_id, $vote);
	}
}

$feedback_votes = get_feedback_votes($feedback_id);
$user_feedback_vote = get_feedback_vote(USER['user_id'], $feedback_id);

$json = [
	'ok' => true,
	'result' => [
		'feedback_votes' => [
			'user_vote' => empty($user_feedback_vote) ? 0 : $user_feedback_vote[0]['vote'],
			'vote_count' => intval($feedback_votes[0]['total']),
		],
	],
];

http_response_code(200);
die(json_encode($json));
