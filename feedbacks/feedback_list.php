<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
define("PAGE_TITLE", "FeedBack");
define("NAVIGATION_PAGE", "feedback");
define("NAVIGATION_PAGE_FEEDBACK", $category);

if (!defined("ROUTER_REQUIRED")) {die();}

require_once "includes/utils/session.php";
require_once "includes/utils/commons.php";
require_once "includes/components/templates/template.php";
require_once "includes/utils/database/feedbacks.php";

$feedbacks = get_feedbacks_full($category);

?>

<!DOCTYPE html>
<html lang="it">

<head>
	<?php include "includes/components/structure/head.php";?>
</head>

<body class="select-none h-screen bg-base-200">

	<main id="swup" class="bg-base-200">

		<?php include "includes/components/structure/navigations/main/top.php";?>

		<?php include "includes/components/structure/navigations/pages/feedbacks.php";?>

		<div class="transition-slide-down">
			<div class="container max-w-3xl mx-auto pt-1 px-6">
				<a href="/feedbacks/add/"
					class="btn btn-square rounded-full fixed z-50 bottom-24 right-4 flex justify-center items-center text-accent btn-quick-action">
					<span class="material-symbols-rounded">add</span>
				</a>
			</div>

			<div class="container max-w-3xl mx-auto pb-24">

				<?php for ($i = 0; $i < count($feedbacks); $i++): ?>
				<?php template_HTML("feedbacks/feedback", $feedbacks[$i]);?>
				<?php endfor;?>

			</div>

		</div>

		<?php include "includes/components/structure/navigations/main/bottom.php";?>
	</main>


	<?php include "includes/components/structure/scripts/scripts.php";?>

</body>

</html>