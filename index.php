<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
define("PAGE_TITLE", "SegatoBrusto App");
define("NAVIGATION_PAGE", "home");

require_once "includes/utils/session.php";
require_once "includes/components/templates/template.php";

$com = file_get_contents("https://scuola.gioiacca9.tk/api/comunicati/famiglia/?limit=2");
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

		<div class="transition-slide-down">

			<!---Quick action button-->
			<div class="container max-w-3xl mx-auto px-6">

			</div>
			<!---End action button-->

			<div class="container max-w-3xl mx-auto pb-24">

				<div class="px-4 py-4">
					<?php template_HTML("sections/dashboard_messages");?>

					<h1 class="text-4xl font-bold text-base-content my-3">
						<?php if (USER_IS_LOGGED): ?>
						<?php else: ?>
						<span class="text-accent"><a href="/login/">Accedi</a></span> a SegatoBrust App
						<?php endif;?>
					</h1>

					<?php if (USER_IS_LOGGED): ?>
					<?php template_HTML("calendars/class_schedule");?>
					<?php endif;?>

					<?php template_HTML("sections/photo_carousel");?>

					<div class="mt-4">
						<h4 class="text-lg font-semibold">
							Ultimi comunicati
						</h4>
						<div class="my-3">
							<?php for ($i = 0; $i < count($com) && $i < 50; $i++): ?>
							<a href="https://data.iacca.ml/articleextractor/?disable_proxy&id=<?=$com[$i]['comunicato_id'];?>"
								target="_blank">
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

				</div>

			</div>



		</div>

		<?php include "includes/components/structure/navigations/main/bottom.php";?>
	</main>


	<?php include "includes/components/structure/scripts/scripts.php";?>

</body>

</html>