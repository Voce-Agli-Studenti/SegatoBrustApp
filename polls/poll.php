<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
define("NAVIGATION_PAGE", "feedback");
define("PAGE_TITLE", "Sondaggi");

if (!defined("ROUTER_REQUIRED")) {die();}

require_once "includes/utils/session.php";
require_once "includes/utils/commons.php";
require_once "includes/components/templates/template.php";
require_once "includes/utils/database/users.php";
require_once "includes/utils/database/polls.php";
require_once "includes/utils/database/classes.php";
require_once "includes/utils/database/poll_votes.php";

$poll_data = json_decode($poll['data'], true);
$options = $poll_data['options'];
$vote_conditions = $poll_data['vote_conditions'];

$user_can_vote = true;
$user_can_vote_reason = "";

if (USER_IS_LOGGED) {
	$user_class = get_class_by_id(USER['class_id']);

	if (isset($vote_conditions['class_years']) && !empty($vote_conditions['class_years'])) {
		if (!empty($user_class)) {
			$user_class = $user_class[0];

			if (!in_array($user_class['year'], $vote_conditions['class_years'])) {
				$user_can_vote = false;
				$user_can_vote_reason = "Le classi del tuo anno non possono votare";
			}
		} else {
			$user_can_vote = false;
			$user_can_vote_reason = "Non sei uno studente. Non puoi votare";
		}
	} else if (isset($vote_conditions['school']) && !empty($vote_conditions['school'])) {
		if (!empty($user_class)) {
			$user_class = $user_class[0];

			if (!in_array($user_class['school'], $vote_conditions['school'])) {
				$user_can_vote = false;
				$user_can_vote_reason = "Il tuo istituto non può votare";
			}
		} else {
			$user_can_vote = false;
			$user_can_vote_reason = "Non sei uno studente. Non puoi votare";
		}
	}
} else {
	$user_can_vote = false;
	$user_can_vote_reason = "Accedi per esprimere il tuo voto";
}

if (isset($_POST['action_type']) && $_POST['action_type'] == "cast_vote" && $user_can_vote) {
	$pass = true;

	$vote = $_POST['poll_option'];

	$option_ids = [];
	$options = json_decode($poll['data'], true)['options'];

	for ($i = 0; $i < count($options); $i++) {
		$option_ids[] = $options[$i]['id'];
	}

	if (!in_array($vote, $option_ids)) {
		$pass = false;
	}

	if ($pass) {
		cast_poll_vote(USER['user_id'], $poll_id, $vote);
	}
}

$total_votes = get_poll_total_votes_count($poll_id)[0]['total_votes'];
$user_poll_vote = get_poll_vote(USER['user_id'], $poll_id);

?>

<!DOCTYPE html>
<html lang="it">

<head>
	<?php include "includes/components/structure/head.php";?>
</head>

<body class="select-none h-screen bg-base-200">

	<main id="swup" class="bg-base-200">

		<?php include "includes/components/structure/navigations/main/top.php";?>

		<div class="transition-slide-down">
			<div class="container max-w-3xl mx-auto pb-24">
				<div class="bg-base-100">
					<div class="px-4 py-4">
						<div class="mt-4">
							<h2 class="text-lg mb-3 font-medium text-gray-800 dark:text-slate-100">
								<?=htmlspecialchars($poll['title']);?>
							</h2>
							<p class="text-sm">
								<?=nl2br(htmlspecialchars($poll['description']));?>
							</p>
							<p class="text-sm text-error">
								<?=htmlspecialchars($user_can_vote_reason)?>
							</p>

							<div class="mt-10">
								<form action="" method="post">
									<input type="hidden" name="action_type" value="cast_vote">

									<?php foreach ($options as $option): ?>
									<div class="mb-4">
										<p class="mb-2 font-bold">
											<?=htmlspecialchars($option['title']);?>
										</p>
										<div class="flex items-center">
											<div class="form-control w-full">
												<label class="label cursor-pointer">
													<input type="radio" name="poll_option" onchange="this.form.submit()"
														value="<?=$option['id'];?>" class="radio radio-accent mr-2"
														<?=($user_poll_vote[0]['vote'] ?? - 1) == $option['id'] ? "checked" : ""?> 
														<?= $user_can_vote ? "" : "disabled"?>
														/>
													<span class="label-text w-full">
														<progress class="progress progress-accent w-full"
															value="<?=get_poll_votes_count($poll['poll_id'], $option['id'])[0]['vote_count'];?>"
															max="<?=$total_votes;?>"></progress>
													</span>
												</label>
											</div>

										</div>
									</div>
									<?php endforeach;?>
								</form>

							</div>


						</div>
					</div>





				</div>
			</div>

		</div>

		<?php include "includes/components/structure/navigations/main/bottom.php";?>
	</main>


	<?php include "includes/components/structure/scripts/scripts.php";?>

</body>

</html>