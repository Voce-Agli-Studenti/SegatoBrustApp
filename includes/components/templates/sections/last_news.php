<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/session.php";

$limit = $data;

if (USER_IS_TEACHER) {
	$com = file_get_contents("https://scuola.gioiacca9.tk/api/comunicati/personale/?limit=" . $limit);
} else {
	$com = file_get_contents("https://scuola.gioiacca9.tk/api/comunicati/famiglia/?limit=" . $limit);
}

$com = json_decode($com, true);
?>

<div class="mt-4">
	<h4 class="text-lg font-semibold">
		Ultimi comunicati <?=USER_IS_TEACHER ? "personale" : "famiglia"?>
	</h4>
	<div class="my-3">
		<?php for ($i = 0; $i < count($com) && $i < 50; $i++): ?>
		<a href="https://data.iacca.ml/articleextractor/?disable_proxy&id=<?=$com[$i]['comunicato_id'];?>" target="_blank">
			<div class="card rounded mb-1 bg-base-100">
				<div class="card-body">
					<span class="text-lg font-bold truncate-2">
						<?=htmlspecialchars($com[$i]['title']);?>
					</span>
				</div>
			</div>
		</a>
		<?php endfor;?>
	</div>
</div>