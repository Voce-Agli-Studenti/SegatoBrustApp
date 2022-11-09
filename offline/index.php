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

<body class="select-none">

	<main id="swup" class="">

		<div class="transition-slide-down">
			<div class="container max-w-3xl mx-auto py-6 px-6">
				<h1 class="text-4xl font-bold text-base-content">
					Nessuna connessione
				</h1>
			</div>

		</div>

		<?php include "includes/components/structure/navigations/main/bottom.php";?>
	</main>


	<?php include "includes/components/structure/scripts/scripts.php";?>

</body>

</html>