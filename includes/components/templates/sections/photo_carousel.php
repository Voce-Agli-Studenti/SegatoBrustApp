<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/session.php";
require_once "includes/components/templates/template.php";
require_once "includes/utils/database/dashboard_messages.php";

$images = get_dashboard_messages_by_category("carousel");
?>

<div class="carousel carousel-center w-full space-x-4 rounded-box">
	<?php for ($i = 0; $i < count($images); $i++): ?>
	<div class="carousel-item">

		<label for="modal_image_<?=$images[$i]['dashboard_message_id'];?>">
			<img src="<?=$images[$i]['image_url'];?>" class="w-full rounded max-h-72 object-cover" />
			<div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">

			</div>
		</label>

		<!-- Put this part before </body> tag -->
		<input type="checkbox" id="modal_image_<?=$images[$i]['dashboard_message_id'];?>" class="modal-toggle" />
		<label for="modal_image_<?=$images[$i]['dashboard_message_id'];?>" class="modal cursor-pointer">
			<label class="modal-box relative" for="">
				<label for="modal_image_<?=$images[$i]['dashboard_message_id'];?>"
					class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
				<h3 class="text-lg font-bold mb-2"><?=htmlspecialchars($images[$i]['title'])?></h3>
				<img src="<?=$images[$i]['image_url'];?>" class="w-full rounded object-cover" />
			</label>
		</label>
	</div>
	<?php endfor;?>
</div>