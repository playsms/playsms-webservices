<?php

error_reporting(E_ALL ^ E_NOTICE);

require 'vendor/autoload.php';

$ws = new Playsms\Webservices;

// if you want to test with other username
// go to http://playsms.org/trial and register for username/password
// its a demo website, sms will not be sent to mobiles
$ws->url = 'http://playsms.org/trial/index.php?app=ws';
$ws->username = 'admin';
$ws->password = 'donotchangeme';

// get token from username and password
$ws->getToken();

if (! $ws->getStatus()) {
	echo "Error code: " . $ws->getError() . "\n";
	echo "Error string: " . $ws->getErrorString() . "\n";
	exit();
}

echo "Token: " . $ws->getData()->token . "\n";

// get user's credit
$ws->token = $ws->getData()->token;
$ws->getCredit();
$credit = ( $ws->getStatus ? $ws->getData()->credit : 0 );

echo "User credit: " . $credit . "\n";
