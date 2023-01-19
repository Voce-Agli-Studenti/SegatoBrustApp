<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
define("PAGE_TITLE", "Accedi");
define("NAVIGATION_PAGE", "");

require_once "includes/utils/session.php";
require_once "includes/utils/commons.php";
require_once "includes/utils/moodle_api.php";
require_once "includes/utils/database/users.php";
require_once "includes/utils/database/classes.php";

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

		$username = trim($_POST['username']);
		$password = $_POST['password'];
		$moodle_login = moodle_login($username, $password);

		if ($moodle_login) {
			$user_data = moodle_get_user_info($moodle_login['token'], $username);
			
			if (empty($user_data) || isset($user_data['exception'])) {
				$password_error = "Nome utente o password errati";
			} else {
				$site_data = moodle_get_site_info($moodle_login['token']);
				
				$user_data = $user_data[0];
				$user_id = get_user_id($user_data['id']);

				$user_courses = moodle_get_user_courses($moodle_login['token'], $user_data['id']);

				$class_id = null;

				foreach ($user_courses as $course) {

					if ($course['id'] == 2771) {
						// L'utente è un insegnante: è iscritto al corso del collegio docenti
						$class_id = TEACHER_CLASS_ID;
						break;
					}

					if (class_exists_by_moodle_category_id($course['category'])) {
						// L'utente è iscritto ad un corso che appartiene ad una clase conosciuta
						$class_id = get_class_by_moodle_category_id($course['category'])[0]['class_id'];
						break;
					}
				}

				// Converte il case dei nomi
				$first_name = ucname(strtolower($site_data['firstname']));
				$last_name = ucname(strtolower($site_data['lastname']));

				if (user_exists_by_id($user_id)) {
					// L'utente è già registrato. Aggiorna le informazioni

					edit_user($user_id, $first_name, $last_name, $user_data['email'], $user_data['profileimageurl'], $class_id, false);
				} else {
					// L'utente non è registrato nel DB. Lo registra

					add_user($user_data['id'], $first_name, $last_name, $user_data['email'], $user_data['profileimageurl'], $class_id, false);
				}

				setcookie("moodle_token", $moodle_login['token'], time() + 60 * 60 * 24 * 7 * 12, "/", "", true, false);
				setcookie("moodle_private_token", $moodle_login['privatetoken'], time() + 60 * 60 * 24 * 7 * 12, "/", "", true, false);
				$_SESSION['user_id'] = $user_id;
				redirect("/");
			}

		} else {
			$password_error = "Nome utente o password errati";
		}
	}

}

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
			<div class="container max-w-3xl mx-auto py-6 px-6">
				<h1 class="text-4xl font-bold text-base-content">
					Accedi
				</h1>

				<div class="flex flex-wrap justify-center mt-10">
					<div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2">
						<form action="" method="POST" class="" id="submitForm">
							<input type="hidden" name="action_type" value="login">
							<div class="form-control w-full">
								<label class="label">
									<span class="label-text">Username di Moodle</span>
								</label>
								<input type="text" placeholder="Username" name="username" class="input input-bordered w-full"
									autofocus />
								<label class="label">
									<span class="label-text-alt text-error"><?=$username_error ?? "";?></span>
								</label>
							</div>

							<div class="form-control w-full mt-2">
								<label class="label">
									<span class="label-text">Password di Moodle</span>
								</label>
								<input type="password" placeholder="Password" name="password" class="input input-bordered w-full" />
								<label class="label">
									<span class="label-text-alt text-error"><?=$password_error ?? "";?></span>
								</label>
							</div>

							<div class="flex justify-end">
								<button type="submit" class="btn btn-outline btn-accent" id="submitBtn">
									ACCEDI
								</button>
							</div>

						</form>
					</div>
				</div>
			</div>

		</div>

		<?php include "includes/components/structure/navigations/main/bottom.php";?>
		<?php include "includes/components/structure/scripts/form_submit_loading.php";?>
		
	</main>


	<?php include "includes/components/structure/scripts/scripts.php";?>

</body>

</html>