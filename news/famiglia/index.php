<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
define("PAGE_TITLE", "Comunicati scuola-famiglia");
define("NAVIGATION_PAGE", "news");
define("NAVIGATION_PAGE_NEWS", "famiglia");

require_once "includes/utils/session.php";

$com = file_get_contents("https://scuola.gioiacca9.tk/api/comunicati/famiglia/");
$com = json_decode($com, true);

?>

<!DOCTYPE html>
<html lang="it">

<head>
	<?php include "includes/components/structure/head.php";?>
</head>

<body class="select-none h-screen bg-base-200">

	<main id="swup" class="bg-base-200">

		<?php include "includes/components/structure/navigations/main/top.php";?>

		<?php include "includes/components/structure/navigations/pages/news.php";?>

		<div class="transition-slide-down">
			<div class="container max-w-3xl mx-auto pt-1 pb-24">
				<?php for ($i = 0; $i < count($com) && $i < 50; $i++): ?>
					<a href="https://data.iacca.ml/articleextractor/?disable_proxy&id=<?=$com[$i]['comunicato_id'];?>"
					target="_blank">
					<div class="card rounded mb-1 bg-base-100">
						<div class="card-body">
							<span class="text-lg font-bold truncate-2">
								<?=htmlspecialchars($com[$i]['title']);?>
							</span>
							<p class="truncate-2">
								<?=htmlspecialchars($com[$i]['description']);?>
							</p>

						</div>
					</div>
				</a>
				<?php endfor;?>
			</div>
		</div>

		<?php include "includes/components/structure/navigations/main/bottom.php";?>
	</main>


	<?php include "includes/components/structure/scripts/scripts.php";?>

</body>

</html>