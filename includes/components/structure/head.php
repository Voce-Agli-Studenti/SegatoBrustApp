<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?=defined("PAGE_TITLE") ? htmlspecialchars(PAGE_TITLE) : "";?></title>
<meta name="description" content="La nuova app dell'istituto Segato-Brustolon">
<link rel="manifest" href="/manifest.json" />
<link defer rel="stylesheet" href="/assets/css/style.min.css?v=1.54">
<link defer rel="stylesheet" href="/assets/css/style.css?v=1.0">

<meta property="og:title" content="<?=defined("PAGE_TITLE") ? htmlspecialchars(PAGE_TITLE) : "";?>" />
<meta property="og:site_name" content="SegatoBrust App" />
<meta property="og:description" content="La nuova app dell'istituto Segato-Brustolon" />
<meta property="og:type" content="website" />
<meta property="og:url" content="https://app.voceaglistudenti.ml" />
<meta property="og:image" content="https://app.voceaglistudenti.ml/assets/img/icon-512.png" />
<link defer rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,300,0..1,-50..200" />

<meta name="theme-color" content="#00B2A7">
<link rel="apple-touch-icon" href="/assets/img/icon-512.png">

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<?php if (USER_IS_LOGGED):?>
<script src="/assets/js/notifications.js?v=1.1"></script>
<?php endif;?>