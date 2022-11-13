<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/database/feedback_votes.php";
require_once "includes/utils/database/feedbacks.php";

$feedback_id = $data['feedback_id'];

$feedback_votes = get_feedback_votes($feedback_id);

if (USER_IS_LOGGED) {
	$user_feedback_vote = get_feedback_vote(USER['user_id'], $feedback_id);
	$user_vote = empty($user_feedback_vote) ? 0 : $user_feedback_vote[0]['vote'];
} else {
	$user_vote = 0;
}

$vote_count = intval($feedback_votes[0]['total']);

?>

<?php if (USER_IS_LOGGED): ?>
<button class="align-middle outline-none" onclick="castVote('<?=$feedback_id;?>', 1)">
	<span class="material-symbols-rounded <?=$user_vote == 1 ? "icon-fill text-success" : "";?>"
		id="thbup_<?=$feedback_id;?>">
		thumb_up
	</span>
</button>
<span class="mx-1" id="thbcn_<?=$feedback_id;?>">
	<?=$vote_count;?>
</span>
<button class="align-middle outline-none" onclick="castVote('<?=$feedback_id;?>', -1)">
	<span class="material-symbols-rounded <?=$user_vote == -1 ? "icon-fill text-error" : "";?>"
		id="thbdn_<?=$feedback_id;?>">
		thumb_down
	</span>
</button>
<?php else: ?>
<button class="align-middle outline-none tooltip" data-tip="Accedi">
	<span class="material-symbols-rounded <?=$user_vote == 1 ? "icon-fill text-success" : "";?>"
		id="thbup_<?=$feedback_id;?>">
		thumb_up
	</span>
</button>
<span class="mx-1" id="thbcn_<?=$feedback_id;?>">
	<?=$vote_count;?>
</span>
<button class="align-middle outline-none tooltip" data-tip="Accedi">
	<span class="material-symbols-rounded <?=$user_vote == -1 ? "icon-fill text-error" : "";?>"
		id="thbdn_<?=$feedback_id;?>">
		thumb_down
	</span>
</button>
<?php endif;?>