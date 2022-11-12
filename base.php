<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
define("PAGE_TITLE", "SegatoBrusto App");
define("NAVIGATION_PAGE", "home");

require_once "includes/utils/session.php";

?>

<!DOCTYPE html>
<html lang="it">

<head>
	<?php include "includes/components/structure/head.php";?>
</head>

<body class="select-none h-screen bg-base-200">

	<main id="swup" class="">

		<?php include "includes/components/structure/navigations/main/top.php";?>

		<div class="transition-slide-down">

			<!---Quick action button-->
			<div class="container max-w-3xl mx-auto px-6">
				<a href="#"
					class="btn btn-square rounded-full fixed z-90 bottom-24 right-4 flex justify-center items-center text-accent">
					<span class="material-symbols-rounded">comment</span>
				</a>
			</div>
			<!---End action button-->


			<!--Full width container-->
			<div class="container max-w-3xl mx-auto pb-24">

				<!--Default padded container-->
				<div class="px-4 py-4">

				</div>
				<!--End default padded container-->

			</div>
			<!--End full width container-->

		</div>

		<?php include "includes/components/structure/navigations/main/bottom.php";?>
	</main>


	<?php include "includes/components/structure/scripts/scripts.php";?>

</body>

</html>