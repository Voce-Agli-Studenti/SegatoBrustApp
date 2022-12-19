<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
define("PAGE_TITLE", "Nuovo FeedBack");
define("NAVIGATION_PAGE", "feedback");

if (!defined("ROUTER_REQUIRED")) {die();}

require_once "includes/utils/session.php";
require_once "includes/utils/commons.php";
require_once "includes/utils/database/feedbacks.php";
require_once "includes/utils/database/feedback_medias.php";

if (isset($_POST['action_type']) && $_POST['action_type'] == "new_feedback") {
	$pass = true;
	$title = $_POST['title'] ?? "";
	$description = $_POST['description'] ?? "";
	$category = $_POST['category'] ?? "";
	$is_anonymous = false;

	if (!isset($title) || empty($title)) {
		$title_error = "Il titolo è obbligatorio";
		$pass = false;
	}

	if (!($category == "app" || $category == "school" || $category == "idea")) {
		$category_error = "Scegliere una categoria tra quelle nella lista";
		$pass = false;
	}

	if (isset($_POST['is_anonymous'])) {
		$is_anonymous = true;
	}	

	if ($pass) {
		
		$feedback_id = add_feedback(USER['user_id'], $title, $description, $is_anonymous, $category);
		
		if ($feedback_id) {
			if (!empty($_FILES['media'])) {
				$media = file_get_contents($_FILES['media']['tmp_name']);
				add_feedback_media($feedback_id, $media, $_FILES['media']['type']);
			}

			redirect("/feedbacks/" . $feedback_id);
		}

	}
}

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
				<div class="px-3 mt-4">
					<form action="" method="post" id="submitForm" enctype="multipart/form-data">
						<input type="hidden" name="action_type" value="new_feedback">
						<div class="form-control w-full">
							<input type="text" name="title" placeholder="Titolo"
								class="input input-bordered w-full <?=empty($title_error) ? "" : "input-error";?>" autofocus required />
							<label class="label">
								<span class="label-text-alt text-error"><?=$title_error ?? "";?></span>
							</label>
						</div>
						<textarea class="textarea textarea-bordered w-full" name="description" placeholder="Descrizione"
							rows="10"></textarea>

						<div class="form-control my-4">
							<label class="label">
								<span class="text-md font-bold">Foto o video</span>
							</label>
							<input type="file" class="file-input w-full" name="media" accept="image/*,video/*"
								capture="environment" />
						</div>
						<div class="form-control my-4">
							<label class="label">
								<span class="text-md font-bold">Categoria</span>
							</label>
							<div class="form-control">
								<label class="label cursor-pointer">
									<span class="label-text">Scuola</span>
									<input type="radio" name="category" value="school" class="radio checked:bg-accent" checked />
								</label>
							</div>
							<div class="form-control">
								<label class="label cursor-pointer">
									<span class="label-text">App</span>
									<input type="radio" name="category" value="app" class="radio checked:bg-accent" />
								</label>
							</div>
							<div class="form-control">
								<label class="label cursor-pointer">
									<span class="label-text">Idea</span>
									<input type="radio" name="category" value="ideas" class="radio checked:bg-accent" />
								</label>
							</div>
							<label class="label">
								<span class="label-text-alt text-error"><?=$category_error ?? "";?></span>
							</label>
						</div>
						<div class="form-control w-min flex flex-row mt-2">
							<label class="label cursor-pointer">
								<input type="checkbox" name="is_anonymous" class="checkbox mr-2" />
								<span class="label-text whitespace-nowrap mr-2">
									Anonimo
								</span>
								<div class="tooltip tooltip-top h-min" data-tip="Il tuo nome non verrà pubblicato">
									<span class="material-symbols-rounded">help</span>
								</div>
							</label>
						</div>

						<div class="flex justify-end">
							<button type="submit" class="btn btn-accent" id="submitBtn">
								Pubblica
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
	<?php include "includes/components/structure/scripts/file_input.php";?>
</body>

</html>