<?php



$stdin = fopen('php://stdin', 'r');
echo 'Hello ' . json_encode($_SERVER) . "!\n";
while ($line = fgets($stdin)) {
	echo 'Hello ' . json_encode($_SERVER) . "!\n";
}