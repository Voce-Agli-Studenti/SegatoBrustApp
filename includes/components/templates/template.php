<?php

set_include_path($_SERVER['DOCUMENT_ROOT']);
ob_start();

function template_text($component, $data = [], $options = []) {
	$component = "includes/components/templates/" . $component . ".php";
	if (!file_exists(get_include_path() . "/" . $component)) {
		return '';
	}

	ob_start();
	require_once $component;
	$body = ob_get_contents();
	ob_clean();
	return $body;
}

function template_HTML($component, $data = [], $options = []) {
	$component = "includes/components/templates/" . $component . ".php";

	if (!file_exists(get_include_path() . "/" . $component)) {
		return '';
	}

	include $component;
	ob_flush();
	flush();
}