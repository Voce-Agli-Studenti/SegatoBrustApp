<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
define("PAGE_TITLE", "Sondaggi");
define("NAVIGATION_PAGE", "services");
define("NAVIGATION_PAGE_FEEDBACK", $category);

if (!defined("ROUTER_REQUIRED")) {die();}

require_once "includes/utils/session.php";
require_once "includes/utils/commons.php";
require_once "includes/components/templates/template.php";
require_once "includes/utils/database/feedbacks.php";

$polls = get_polls();

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

				<?php for ($i = 0; $i < count($polls); $i++): ?>
				<?php template_HTML("polls/poll", $polls[$i]);?>
				<?php endfor;?>

			</div>

		</div>

		<?php include "includes/components/structure/navigations/main/bottom.php";?>
	</main>


	<?php include "includes/components/structure/scripts/scripts.php";?>

</body>

</html>