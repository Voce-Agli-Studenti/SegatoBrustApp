<?php
$feedback = $data;
?>


<div class="card rounded mb-1 bg-base-100">
	<div class="card-body p-4">
		<a href="/feedbacks/<?=$feedback['feedbacks.feedback_id']?>" class="text-lg text-slate-800 dark:text-slate-200 leading-6 truncate-3 text-base">
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
			<div class="mt-2">
				<?=htmlspecialchars($feedback['feedbacks.title'])?>
			</div>
		</a>
	</div>
</div>