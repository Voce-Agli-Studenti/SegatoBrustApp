<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
define("PAGE_TITLE", "News");
define("NAVIGATION_PAGE", "news");
define("NAVIGATION_PAGE_NEWS", "news");

require_once "includes/utils/session.php";

$com = file_get_contents("https://scuola.gioiacca9.tk/api/news/");
$com = json_decode($com, true);

?>

<!DOCTYPE html>
<html lang="it">

<head>
	<?php include "includes/components/structure/head.php";?>
</head>

<body class="select-none">

	<main id="swup" class="">

		<?php include "includes/components/structure/navigations/main/top.php";?>

		<?php include "includes/components/structure/navigations/pages/news.php";?>

		<div class="transition-slide-down">
			<div class="container max-w-3xl mx-auto pt-6 pb-24">
				<?php for ($i = 0; $i < count($com) && $i < 50; $i++):?>
				<div class="card shadow-lg rounded-none mb-1">
					<div class="card-body">
						<a href="#" class="text-lg font-bold truncate-2">
							<?=htmlspecialchars($com[$i]['title'])?>
						</a>
						<p class="truncate-2">
							<?=htmlspecialchars($com[$i]['description'])?>
						</p>
						
					</div>
				</div>
				<?php endfor;?>
			</div>
		</div>

		<?php include "includes/components/structure/navigations/main/bottom.php";?>
	</main>


	<?php include "includes/components/structure/scripts/scripts.php";?>

</body>

</html>