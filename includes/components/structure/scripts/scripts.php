<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
?>

<script src="/assets/js/pwa.js?v=2"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://unpkg.com/swup@latest/dist/swup.min.js"></script>
<script src="/assets/js/swup.js?v=1"></script>
<?php if (USER_IS_LOGGED):?>
<script src="/assets/js/notifications.js?v=1.1"></script>
<?php endif;?>