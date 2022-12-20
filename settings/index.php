<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
//define("LOGIN_REQUIRED", true);
define("PAGE_TITLE", "Impostazioni");
define("NAVIGATION_PAGE", "settings");

require_once "includes/utils/session.php";
require_once "includes/utils/commons.php";

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
					<h1 class="text-xl font-semibold text-base-content mb-2">
						Notifiche
					</h1>
					<button class="btn normal-case" onclick="notificationBtnClick()" id="push-subscription-button">
						Abilita notifiche
					</button>
				</div>
			</div>

		</div>

		<?php include "includes/components/structure/navigations/main/bottom.php";?>
	</main>

	<?php include "includes/components/structure/scripts/scripts.php";?>

</body>

</html>