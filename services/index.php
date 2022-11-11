<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
//define("LOGIN_REQUIRED", true);
define("PAGE_TITLE", "Servizi");
define("NAVIGATION_PAGE", "Services");
define("NAVIGATION_PAGE_SERVICES", "Services");

require_once "includes/utils/session.php";
require_once "includes/utils/commons.php";

?>
<!DOCTYPE html>
<html lang="it">

<head>
    <?php include "includes/components/structure/head.php";?>
</head>

<body class="select-none h-screen bg-base-200">

    <main id="swup" class="">

        <?php include "includes/components/structure/navigations/main/top.php";?>

        <?php include "includes/components/structure/navigations/main/bottom.php";?>

        <div class="transition-slide-down">
            <div class="container max-w-3xl mx-auto pt-6 pb-24">
                <h1 class="text-4xl font-bold text-base-content">
                    <span class="text-accent">In Costruzione</span>
                </h1>
            </div>
        </div>

        <?php include "includes/components/structure/scripts/scripts.php";?>

    </main>

    <?php include "includes/components/structure/scripts/scripts.php";?>

</body>

</html>
