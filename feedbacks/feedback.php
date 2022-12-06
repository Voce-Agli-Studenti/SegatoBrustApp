<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
define("NAVIGATION_PAGE", "feedback");
define("PAGE_TITLE", "FeedBack");

if (!defined("ROUTER_REQUIRED")) {die();}

require_once "includes/utils/session.php";
require_once "includes/utils/commons.php";
require_once "includes/components/templates/template.php";
require_once "includes/utils/database/users.php";
require_once "includes/utils/database/feedbacks.php";
require_once "includes/utils/database/feedback_votes.php";
require_once "includes/utils/database/feedback_comments.php";

if (isset($_POST['action_type']) && $_POST['action_type'] == "add_comment") {
	$pass = true;

	$comment_text = trim($_POST['comment_text'] ?? "");

	if (empty($comment_text)) {
		$pass = false;
	}

	if (!USER_IS_LOGGED) {
		$pass = false;
		redirect("/login/");
	}

	if ($pass) {
		add_feedback_comment($feedback_id, USER['user_id'], $comment_text);
	}
}

$feedback = get_feedback_full_by_id($feedback_id)[0];

$comments = get_feedback_comments_full($feedback_id);
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
			<?php if (USER_IS_LOGGED): ?>
			<div class="container max-w-3xl mx-auto px-6 absolute">
				<!-- The button to open modal -->
				<label for="my-modal-4"
					class="btn btn-square rounded-full fixed z-50 bottom-24 right-4 flex justify-center items-center text-accent btn-quick-action">
					<span class="material-symbols-rounded">comment</span>
				</label>

				<input type="checkbox" id="my-modal-4" class="modal-toggle" />
				<label for="my-modal-4" class="modal modal-bottom sm:modal-middle cursor-pointer">
					<label class="modal-box p-4 relative" for="">
						<label for="my-modal-4" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
						<h3 class="text-lg font-bold">
							Commenta
						</h3>
						<div class="mt-3">
							<form action="" method="post">
								<input type="text" placeholder="Aggiungi un commento" class="input input-bordered w-full"
									name="comment_text" />
								<input type="hidden" name="action_type" value="add_comment">
								<button type="submit" class="btn w-full btn-accent mt-3">
									Commenta
								</button>
							</form>
						</div>
					</label>
				</label>
			</div>
			<?php endif?>



			<div class="container max-w-3xl mx-auto pb-24">
				<div class="bg-base-100">
					<div class="px-4 py-4">
						<div class="flex">
							<div class="avatar mr-2">
								<div class="w-8 h-8 rounded-full my-auto">
									<img
										src="<?=boolval($feedback['feedbacks.is_anonymous']) ? "/assets/img/icons/user.png" : $feedback['users.avatar_url'];?>"
										alt="<?=boolval($feedback['feedbacks.is_anonymous']) ? "Utente anonimo" : htmlspecialchars($feedback['users.first_name'] . " " . $feedback['users.last_name']);?>">
								</div>
							</div>
							<div class="">
								<p class="text-sm font-semibold text-gray-800 dark:text-slate-100">
									<?=boolval($feedback['feedbacks.is_anonymous']) ? "Utente anonimo" : htmlspecialchars($feedback['users.first_name'] . " " . $feedback['users.last_name']);?>
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
					</div>
					<div class="flex justify-between px-4 pb-4">
						<?php if ($user_can_edit_feedback): ?>
						<div class="z-20">
							<a href="/feedbacks/<?=$feedback['feedbacks.feedback_id']?>/edit/" class="align-middle outline-none">
								<span class="material-symbols-rounded">edit</span>
							</a>
						</div>
						<?php endif;?>
						<div class="ml-auto">
							<?php template_HTML("feedbacks/vote_section", ['feedback_id' => $feedback['feedbacks.feedback_id']]);?>
						</div>
					</div>
				</div>
				
				<div class="">
					<?php foreach ($comments as $comment): ?>
						<?php template_HTML("feedbacks/comment", $comment);?>
					<?php endforeach;?>
				</div>
			</div>

		</div>

		<?php include "includes/components/structure/navigations/main/bottom.php";?>
	</main>


	<?php include "includes/components/structure/scripts/scripts.php";?>

</body>

</html>