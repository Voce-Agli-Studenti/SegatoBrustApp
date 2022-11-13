<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/components/templates/template.php";
$feedback = $data;
?>


<div class="card rounded mb-1 bg-base-100 cursor-pointer">
	<div class="card-body p-4">

		<div class="flex">
			<div class="flex">
				<div class="avatar mr-2">
					<div class="w-8 h-8 rounded-full my-auto">
						<img
							src="<?=boolval($feedback['feedbacks.is_anonymous']) ? "/assets/img/icons/user.png" : $feedback['users.avatar_url'] ?>"
							alt="<?=boolval($feedback['feedbacks.is_anonymous']) ? "Utente anonimo" : htmlspecialchars($feedback['users.name']) ?>">
					</div>
				</div>
				<div class="">
					<p class="text-sm font-semibold text-gray-800 dark:text-slate-100">
						<?=boolval($feedback['feedbacks.is_anonymous']) ? "Utente anonimo" : htmlspecialchars($feedback['users.name']) ?>
					</p>
					<p class="text-xs text-gray-600 dark:text-slate-400">
						<?=time_elapsed_string($feedback['feedbacks.creation_date'])?></p>
				</div>
			</div>
		</div>
		<a href="/feedbacks/<?=$feedback['feedbacks.feedback_id']?>" class="text-lg text-slate-800 dark:text-slate-200 leading-6 truncate-3 text-base
			after:absolute after:top-0 after:bottom-0 after:right-0 after:left-0 after:z-10 outline-none
			">
			<div class="mt-2">
				<?=htmlspecialchars($feedback['feedbacks.title'])?>
			</div>
		</a>
		<div class="grid">
			<div class="justify-self-end z-20">
				<?php template_HTML("feedbacks/vote_section", ['feedback_id' => $feedback['feedbacks.feedback_id']])?>
			</div>
		</div>

	</div>
</div>