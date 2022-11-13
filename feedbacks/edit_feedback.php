<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
define("PAGE_TITLE", "Modifica FeedBack");
define("NAVIGATION_PAGE", "feedback");

if (!defined("ROUTER_REQUIRED")) {die();}

require_once "includes/utils/session.php";
require_once "includes/utils/commons.php";
require_once "includes/utils/database/feedbacks.php";

if (isset($_POST['action_type']) && $_POST['action_type'] == "edit_feedback") {
	$pass = true;
	$title = $_POST['title'] ?? "";
	$description = $_POST['description'] ?? "";
	$is_anonymous = false;

	if (isset($_POST['is_anonymous'])) {
		$is_anonymous = true;
	}	

	if ($pass) {
		edit_feedback($feedback_id, $feedback['title'], $description, $is_anonymous);
		
		redirect("/feedbacks/" . $feedback_id);
	}
}

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


			<div class="container max-w-3xl mx-auto pb-24">
				<div class="px-3 mt-4">
					<form action="" method="post" id="submitForm">
						<input type="hidden" name="action_type" value="edit_feedback">
						<div class="form-control w-full">
							<input type="text" name="title" placeholder="Titolo"
								class="input input-bordered w-full <?=empty($title_error) ? "" : "input-error";?>"
								value="<?=htmlspecialchars($feedback['title'] ?? "")?>" disabled autofocus required />
							<label class="label">
								<span class="label-text-alt text-error"><?=$title_error ?? "";?></span>
							</label>
						</div>
						<textarea class="textarea textarea-bordered w-full" name="description" placeholder="Descrizione"
							rows="10"><?=htmlspecialchars($feedback['description'] ?? "")?></textarea>
						<div class="form-control w-min flex flex-row">
							<label class="label cursor-pointer">
								<input type="checkbox" name="is_anonymous" class="checkbox mr-2"
									<?=boolval($feedback['is_anonymous']) ? "checked" : ""?> />
								<span class="label-text whitespace-nowrap mr-2">
									Anonimo
								</span>
								<div class="tooltip tooltip-top h-min" data-tip="Il tuo nome non verrà pubblicato">
									<span class="material-symbols-rounded">help</span>
								</div>
							</label>
						</div>
						<!-- <div class="my-2 mb-3">
							<label class="label">
								<span class="label-text">Foto</span>
							</label>
							<input type="file" name="media[]" class="file-input file-input-bordered w-full" multiple />
						</div> -->
						<div class="flex justify-end">
							<button type="submit" class="btn btn-accent" id="submitBtn">
								Salva
							</button>
						</div>
					</form>
				</div>
			</div>

		</div>

		<?php include "includes/components/structure/navigations/main/bottom.php";?>
		<?php include "includes/components/structure/scripts/form_submit_loading.php";?>
	</main>


	<?php include "includes/components/structure/scripts/scripts.php";?>
</body>

</html>