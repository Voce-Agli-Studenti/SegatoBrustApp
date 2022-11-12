<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
define("NAVIGATION_PAGE", "feedback");
define("PAGE_TITLE", "FeedBack");

if (!defined("ROUTER_REQUIRED")) {die();}

require_once "includes/utils/session.php";
require_once "includes/utils/commons.php";
require_once "includes/components/templates/template.php";
require_once "includes/utils/database/users.php";
require_once "includes/utils/database/feedback_votes.php";
require_once "includes/utils/database/feedbacks.php";

if (isset($_POST['action_type']) && $_POST['action_type'] == "login") {
	$pass = true;

	if (!isset($_POST['username']) || empty($_POST['username'])) {
		$username_error = "L'username è obbligatorio";
		$pass = false;
	}
}

$feedback = get_feedback_full_by_id($feedback_id)[0];
?>

<!DOCTYPE html>
<html lang="it">

<head>
	<?php include "includes/components/structure/head.php";?>
</head>

<body class="select-none h-screen bg-base-200">

	<main id="swup" class="">

		<?php include "includes/components/structure/navigations/main/top.php";?>

		<div class="transition-slide-down">
			<div class="container max-w-3xl mx-auto px-6">
				<a href="/feedbacks/add/"
					class="btn btn-square rounded-full fixed z-90 bottom-24 right-4 flex justify-center items-center text-accent btn-quick-action">
					<span class="material-symbols-rounded">comment</span>
				</a>
			</div>

			<div class="container max-w-3xl mx-auto pb-24">
				<div class="px-4 py-4 bg-base-100">
					<div class="flex">
						<div class="avatar mr-2">
							<div class="w-8 h-8 rounded-full my-auto">
								<img
									src="<?=boolval($feedback['feedbacks.is_anonymous']) ? "/assets/img/icons/user.png" : $feedback['users.avatar_url'];?>"
									alt="<?=boolval($feedback['feedbacks.is_anonymous']) ? "Utente anonimo" : htmlspecialchars($feedback['users.name']);?>">
							</div>
						</div>
						<div class="">
							<p class="text-sm font-semibold text-gray-800 dark:text-slate-100">
								<?=boolval($feedback['feedbacks.is_anonymous']) ? "Utente anonimo" : htmlspecialchars($feedback['users.name']);?>
							</p>
							<p class="text-xs text-gray-600 dark:text-slate-400">
								<?=time_elapsed_string($feedback['feedbacks.creation_date']);?></p>
						</div>
					</div>
					<div class="mt-4">
						<h2 class="text-lg mb-3 font-medium text-gray-800 dark:text-slate-100">
							<?=htmlspecialchars($feedback['feedbacks.title']);?>
						</h2>
						<p class="text-sm">
							<?=htmlspecialchars($feedback['feedbacks.description']);?>
						</p>
					</div>
					<div class="grid mt-4">
						<div class="justify-self-end">
							<?php template_HTML("feedbacks/vote_section", ['feedback_id' => $feedback['feedbacks.feedback_id']])?>
						</div>
					</div>
				</div>
			</div>

		</div>

		<?php include "includes/components/structure/navigations/main/bottom.php";?>
		
		<?php include "includes/components/structure/scripts/votes.php";?>
	</main>


	<?php include "includes/components/structure/scripts/scripts.php";?>

</body>

</html>