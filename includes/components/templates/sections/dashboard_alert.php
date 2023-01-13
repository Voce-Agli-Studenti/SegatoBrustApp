<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once "includes/utils/session.php";
require_once "includes/components/templates/template.php";
require_once "includes/utils/database/dashboard_messages.php";
require_once "includes/utils/Parsedown.php";

$Parsedown = new Parsedown();
$Parsedown->setSafeMode(true);

$dashboard_alerts = get_dashboard_messages_by_category("alert");
?>

<?php if (!empty($dashboard_alerts[0])): ?>

<a href="<?=$dashboard_alerts[0]['image_url']?>">
	<div class="alert alert-<?=json_decode($dashboard_alerts[0]['text'], true)['color'] ?? "success"?> shadow-lg mb-4">
		<div>
			<div>
				<h3 class="font-bold">
					<?=$Parsedown->line(htmlspecialchars($dashboard_alerts[0]['title']));?>
				</h3>
			</div>
		</div>
	</div>
</a>

<?php endif;?>