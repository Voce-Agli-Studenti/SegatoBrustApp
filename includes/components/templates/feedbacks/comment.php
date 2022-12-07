<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/components/templates/template.php";
require_once "includes/utils/commons.php";

$comment = $data;

?>


<div class="card rounded mb-1 bg-base-100 mt-2">
	<div class="card-body p-4">
		<div class="flex">
			<div class="flex">
				<div class="avatar mr-2">
					<div class="w-6 h-6 rounded-full my-auto">
						<img src="<?=$comment['users.avatar_url'];?>" alt="<?=htmlspecialchars($comment['users.first_name'] . " " . $comment['users.last_name']);?>">
					</div>
				</div>
				<div class="">
					<p class="text-xs font-semibold text-gray-800 dark:text-slate-100">
						<?=htmlspecialchars($comment['users.first_name'] . " " . $comment['users.last_name']);?>
					</p>
					<p class="text-xs text-gray-600 dark:text-slate-400">
						<?=time_elapsed_string($comment['feedback_comments.creation_date']);?></p>
				</div>
			</div>
		</div>
		<p class="text-sm">
			<?=htmlspecialchars($comment['feedback_comments.text'])?>
		</p>
	</div>
</div>