<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
define("PAGE_TITLE", "Accedi");
define("NAVIGATION_PAGE", "");

include "includes/utils/commons.php";
include "includes/utils/moodle_connections.php";



if (isset($_POST['action_type']) && $_POST['action_type'] == "login") {
	$pass = true;

	if (!isset($_POST['username']) || empty($_POST['username'])) {
		$username_error = "L'username è obbligatorio";
		$pass = false;
	}
	
	if (!isset($_POST['password']) || empty($_POST['password'])) {
		$password_error = "La password è obbligatoria";
		$pass = false;
	}

	if ($pass) {

		$username = $_POST['username'];
		$password = $_POST['password'];
		$result = moodleLogin($username, $password);

		if ($result) {
			redirect("/");
		}
	}


}

?>

<!DOCTYPE html>
<html lang="it">

<head>
	<?php include "includes/components/structure/head.php";?>
</head>

<body class="select-none">

	<main id="swup" class="">

		<?php include "includes/components/structure/navigations/main/top.php";?>

		<div class="transition-slide-down">
			<div class="container max-w-3xl mx-auto py-6 px-6">
				<h1 class="text-4xl font-bold text-base-content">
					Accedi
				</h1>

				<div class="flex flex-wrap justify-center mt-10">
					<div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2">
						<form action="" method="POST" class="">
							<input type="hidden" name="action_type" value="login">
							<div class="form-control w-full">
								<label class="label">
									<span class="label-text">Username di Moodle</span>
								</label>
								<input type="text" placeholder="Username" name="username" class="input input-bordered w-full" />
								<label class="label">
									<span class="label-text-alt text-error"><?=$username_error ?? ""?></span>
								</label>
							</div>

							<div class="form-control w-full mt-2">
								<label class="label">
									<span class="label-text">Password di Moodle</span>
								</label>
								<input type="password" placeholder="Password" name="password" class="input input-bordered w-full" />
								<label class="label">
									<span class="label-text-alt text-error"><?=$password_error ?? ""?></span>
								</label>
							</div>

						</form>
					</div>
				</div>
			</div>

		</div>

		<?php include "includes/components/structure/navigations/main/bottom.php";?>
	</main>


	<?php include "includes/components/structure/scripts/scripts.php";?>

</body>

</html>