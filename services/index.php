<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
//define("LOGIN_REQUIRED", true);
define("PAGE_TITLE", "Servizi");
define("NAVIGATION_PAGE", "services");

require_once "includes/utils/session.php";
require_once "includes/utils/commons.php";

$login_url = "https://moodle.segatobrustolon.edu.it/my/";

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

			<div class="container max-w-3xl mx-auto pb-24">
				<div class="px-4 py-4">
					<h2 class="text-2xl font-semibold text-accent mb-3">
						Servizi
					</h2>

					<div class="flex justify-start mb-4">
						<a href="<?=$login_url?>" class="btn btn-square p-1 mx-1 first:ml-0 last:mr-0" target="_blank">
							<img src="/assets/img/icons/moodle.png" alt="Moodle">
						</a>
					</div>

					<h2 class="text-2xl font-semibold text-accent mb-3">
						Corsi
					</h2>

					<div class="flex justify-start mb-4">
						<a href="/services/courses/math/" class="btn btn-square p-1 mx-1 first:ml-0 last:mr-0">
							<img src="/assets/img/icons/math.png" alt="Corsi di matematica">
						</a>
						<a href="https://data.iacca.ml/articleextractor/?disable_proxy&id=fa99fbbfd70c78ca494e051f576fd34da163dadce871bc1ecf4b4f89" class="btn btn-square p-1 mx-1 first:ml-0 last:mr-0" target="_blank">
							<img src="/assets/img/icons/english.png" alt="Inglese">
						</a>
					</div>


				</div>
			</div>

		</div>

		<?php include "includes/components/structure/navigations/main/bottom.php";?>
	</main>

	<?php include "includes/components/structure/scripts/scripts.php";?>

</body>

</html>