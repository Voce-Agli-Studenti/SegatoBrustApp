<?php if (empty($data['image_url'])):?>
<label for="modal_<?=$data['dashboard_message_id']?>" class="">
	<div class="card card-compact bg-base-100 w-64 h-32">
		<div class="card-body">
			<h2 class="card-title">
				<?=htmlspecialchars($data['title'])?>
			</h2>
			<p>
				<?=htmlspecialchars($data['subtitle'])?>
			</p>
		</div>
	</div>
</label>
<?php else:?>
<label for="modal_<?=$data['dashboard_message_id']?>" class="">
	<div class="card card-compact w-64 h-32 image-full">
		<figure class="object-contain"><img src="<?=$data['image_url']?>" class="h-auto" />
		</figure>
		<div class="card-body">
			<h2 class="card-title">
				<?=htmlspecialchars($data['title'])?>
			</h2>
			<p>
				<?=htmlspecialchars($data['subtitle'])?>
			</p>
		</div>
	</div>
</label>
<?php endif;?>

<!-- Put this part before </body> tag -->
<input type="checkbox" id="modal_<?=$data['dashboard_message_id']?>" class="modal-toggle" />
<label for="modal_<?=$data['dashboard_message_id']?>" class="modal cursor-pointer z-50">
	<label class="modal-box relative" for="">
		<label for="modal_<?=$data['dashboard_message_id']?>" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
		<h3 class="text-lg font-bold">
			<?=htmlspecialchars($data['title'])?>
		</h3>
		<div class="py-4">
			<p>
				<?=nl2br(htmlspecialchars(($data['text'])))?>
			</p>
		</div>
	</label>
</label>