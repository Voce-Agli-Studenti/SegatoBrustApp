<?php

set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/database/activities.php";

$day = date("N", time()) - 1;

if ($day == 6) {
	$day = 0;
}

$activites = get_day_activities_by_class_id(USER['class_id'], $day);
?>



<div class="flex flex-col my-3">
	<?php foreach ($activites as $activity): ?>
	<div class="mr-2 w-full">
		<label for="modal_<?=$activity['activity_id']?>" class="btn w-full mb-2">
			<?=htmlspecialchars($activity['subject']);?>
		</label>

		<input type="checkbox" id="modal_<?=$activity['activity_id']?>" class="modal-toggle" />
		<label for="modal_<?=$activity['activity_id']?>" class="modal cursor-pointer">
			<label class="modal-box relative" for="">
				<h3 class="text-lg font-bold text-center"><?=htmlspecialchars($activity['subject']);?></h3>
				<h6 class="text-xs font-bold mt-5">Aula</h6>
				<p class="">
					<?=htmlspecialchars($activity['room']);?>
				</p>
				<h6 class="text-xs font-bold mt-5">Insegnante</h6>
				<p class="">
					<?=htmlspecialchars($activity['professor']);?>
				</p>
			</label>
		</label>
	</div>

	<?php endforeach;?>
</div>