<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/session.php";
require_once "includes/utils/commons.php";
require_once "includes/utils/database/feedback_comments.php";
require_once "includes/utils/database/feedback_comment_votes.php";

header("Content-type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!USER_IS_LOGGED) {
	$json = ['ok' => false, 'error_code' => 403, 'description' => "Forbidden: login required"];
	http_response_code(403);
	die(json_encode($json));
}

if (!isset($data['feedback_comment_id']) || empty($data['feedback_comment_id'])) {
	$json = ['ok' => false, 'error_code' => 400, 'description' => "Bad Request: feedback_comment_id is required"];
	http_response_code(400);
	die(json_encode($json));
}

if (!isset($data['vote']) || empty($data['vote'])) {
	$json = ['ok' => false, 'error_code' => 400, 'description' => "Bad Request: vote is required"];
	http_response_code(400);
	die(json_encode($json));
}

$feedback_comment_id = $data['feedback_comment_id'];
$vote = intval($data['vote']);

if ($vote != 1 && $vote != -1) {
	$json = ['ok' => false, 'error_code' => 400, 'description' => "Bad Request: invalid value for vote"];
	http_response_code(400);
	die(json_encode($json));
}

$user_feedback_comment_vote = get_feedback_comment_vote(USER['user_id'], $feedback_comment_id);

if (empty($user_feedback_comment_vote)) {
	cast_feedback_comment_vote(USER['user_id'], $feedback_comment_id, $vote);
} else {
	$user_feedback_comment_vote = $user_feedback_comment_vote[0];

	if ($user_feedback_comment_vote['vote'] == $vote) {
		delete_feedback_comment_vote(USER['user_id'], $feedback_comment_id);
	} else {
		cast_feedback_comment_vote(USER['user_id'], $feedback_comment_id, $vote);
	}
}

$feedback_comment_votes = get_feedback_comment_votes($feedback_comment_id);
$user_feedback_comment_vote = get_feedback_comment_vote(USER['user_id'], $feedback_comment_id);

$json = [
	'ok' => true,
	'result' => [
		'feedback_comment_votes' => [
			'user_vote' => empty($user_feedback_comment_vote) ? 0 : $user_feedback_comment_vote[0]['vote'],
			'vote_count' => intval($feedback_comment_votes[0]['total']),
		],
	],
];

http_response_code(200);
die(json_encode($json));
