<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
define("PAGE_TITLE", "SegatoBrusto App");
define("NAVIGATION_PAGE", "home");

require_once "includes/utils/session.php";
require_once "includes/components/templates/template.php";

?>

<!DOCTYPE html>
<html lang="it">

<head>
	<?php include "includes/components/structure/head.php";?>
</head>

<body class="select-none h-screen">

	<main id="swup" class="">

		<?php include "includes/components/structure/navigations/main/top.php";?>

		<div class="transition-slide-down">

			<!---Quick action button-->
			<div class="container max-w-3xl mx-auto px-6">
		
			</div>
			<!---End action button-->

			<div class="container max-w-3xl mx-auto pb-24">

				<div class="px-4 py-4">
					<h1 class="text-4xl font-bold text-base-content">
						<?php if (USER_IS_LOGGED): ?>
						<span class="text-accent">Ciao</span> <?=htmlspecialchars(USER['name'])?>
						<?php else:?>
						<span class="text-accent">Accedi</span> a SegatoBrust App
						<?php endif;?>
					</h1>
					
				</div>

			</div>



		</div>

		<?php include "includes/components/structure/navigations/main/bottom.php";?>
	</main>


	<?php include "includes/components/structure/scripts/scripts.php";?>

</body>

</html>