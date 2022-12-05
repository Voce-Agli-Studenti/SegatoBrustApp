<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/session.php";
require_once "includes/components/templates/template.php";
require_once "includes/utils/database/dashboard_messages.php";

$dashboard_messages = get_dashboard_messages();
?>


<div class="flex overflow-x-scroll pb-10 hide-scroll-bar snap-mandatory snap-x">
	<div class="flex flex-nowrap">
		<?php foreach ($dashboard_messages as $dashboard_message): ?>
		<div class="inline-block px-3 first:pl-0 last:pr-0 snap-center">
			<?php template_HTML("cards/dashboard_message", $dashboard_message);?>
		</div>
		<?php endforeach;?>
	</div>
</div>