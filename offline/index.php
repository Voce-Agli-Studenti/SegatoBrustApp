<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
define("PAGE_TITLE", "SegatoBrusto App");
define("NAVIGATION_PAGE", "");

require_once "includes/utils/session.php";

?>

<!DOCTYPE html>
<html lang="it">

<head>
	<?php include "includes/components/structure/head.php";?>
</head>

<body class="select-none h-screen bg-base-200">

	<main id="swup" class="bg-base-200">

		<div class="transition-slide-down">
			<div class="container max-w-3xl mx-auto pb-24">

				<!--Default padded container-->
				<div class="px-4 py-4">
					<h1 class="text-xl font-bold text-base-content">
						Nessuna connessione
					</h1>
				</div>
				<!--End default padded container-->

			</div>

		</div>

		<?php include "includes/components/structure/navigations/main/bottom.php";?>
	</main>


	<?php include "includes/components/structure/scripts/scripts.php";?>

</body>

</html>