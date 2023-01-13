<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/commons.php";
require_once "includes/utils/database/poll_votes.php";

$poll = $data;
?>


<div class="card rounded mb-1 bg-base-100 cursor-pointer">
	<div class="card-body p-4">
		<a href="/polls/<?=$poll['poll_id']?>" class="text-lg text-slate-800 dark:text-slate-200 leading-6 truncate-3 text-base
			after:absolute after:top-0 after:bottom-0 after:right-0 after:left-0 after:z-10 outline-none">
			<div class="mt-2">
				<h5 class="text-xl">
					<b><?=htmlspecialchars($poll['title'])?></b>
				</h5>
			</div>
		</a>
		<div class="grid">
			<div class="justify-self-start z-20">
				<?=get_poll_total_votes_count($poll['poll_id'])[0]['total_votes'];?>
				voti
			</div>
		</div>

	</div>
</div>