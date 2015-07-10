<?php

include '../src/Playsms/Webservices.php';

error_reporting(E_ALL ^ E_NOTICE);

$ws = new Playsms\Webservices;

// if you want to test with other username
// go to http://playsms.id and register for username/password
// visit http://playsms.org/demo for more information
$ws->url = 'http://playsms.id/index.php?app=ws';
$ws->username = 'your_username';
$ws->token = 'your_token';
$ws->to = 'destination_number';
$ws->msg = 'Hello u there, good morning';
$ws->nofooter = 1;

$ws->sendSms();

//print_r($ws) . PHP_EOL;

if ($ws->getStatus()) {
	echo "Status: TRUE" . PHP_EOL;
	$response = $ws->getData();
	print_r($response) . PHP_EOL;
} else {
	echo "Status: FALSE" . PHP_EOL;
	echo "Error code: " . $ws->getError() . PHP_EOL;
	echo "Error string: " . $ws->getErrorString() . PHP_EOL;
}
