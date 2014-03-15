<?php

include '../src/Playsms/Webservices.php';

error_reporting(E_ALL ^ E_NOTICE);

$ws = new Playsms\Webservices();

$ws->url = 'http://playsms.org/trial/index.php?app=ws';
$ws->username = 'admin';
$ws->password = 'donotchangeme';

echo "\ngetToken\n";
$ws->getToken();
print_r($ws->getData());

echo "\n";

if ($ws->getStatus()) {

	echo "Send SMS:\n";
	$ws->token = $ws->getData()->token;
	$ws->to = '0987654321,0987654322';
	$ws->msg = 'This is a test from webservices ' . time();
	$ws->sendSms();
	print_r($ws->getData());

} else {
	echo "Error code: " . $ws->getError() . "\n";
	echo "Error string: " . $ws->getErrorString() . "\n";
}

echo "\n";
