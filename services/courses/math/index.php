<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
//define("LOGIN_REQUIRED", true);
define("PAGE_TITLE", "Corsi di recupero di matematica");
define("NAVIGATION_PAGE", "services");

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

					<h2 class="text-xl flex mb-3">
						<img src="/assets/img/icons/math.png" alt="Matematica" class="mr-1" height="28" width="28">
						<span>Matematica</span>
					</h2>

					<div class="flex justify-between mb-4">
						<a href="https://forms.gle/1YHDNNgipAakDUUZA" class="btn btn-square mx-2 first:ml-0 last:mr-0" target="_blank" rel="noopener noreferrer">
							1
						</a>
						<a href="https://forms.gle/1YHDNNgipAakDUUZA" class="btn btn-square mx-2 first:ml-0 last:mr-0" target="_blank" rel="noopener noreferrer">
							2
						</a>
						<a href="https://forms.gle/WzCEF8kBGwFekMyT9" class="btn btn-square mx-2 first:ml-0 last:mr-0" target="_blank" rel="noopener noreferrer">
							3
						</a>
						<a href="https://forms.gle/HhQW3Au1UHz8EMin7" class="btn btn-square mx-2 first:ml-0 last:mr-0" target="_blank" rel="noopener noreferrer">
							4
						</a>
						<a href="https://forms.gle/xWzfdfjwAQ9pwJdt5" class="btn btn-square mx-2 first:ml-0 last:mr-0" target="_blank" rel="noopener noreferrer">
							5
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