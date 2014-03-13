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
$get_token = $ws->getToken();
$response = $ws->getResponse();
$data = $response->getData();

if ($response->getStatus()) {
	$token = $data->token;
} else {
	$token = '';
}

echo "Status: ".$data->status."\n";

if ($response->getError()) {
	echo "ERR: ".$response->getError()."\n";
	if ($response->getErrorString()) {
		echo "ERR_STR: ".$response->getErrorString()."\n";
	}
	exit();
}

echo "Token: ".$token."\n";

// get user's credit
unset($response); // discard previous response
unset($data); // discard previous data
$ws->token = $token;
$ws->getCredit();
$response = $ws->getResponse();
$data = $response->getData();

if ($response->getStatus()) {
	$credit = $data->credit;
} else {
	$credit = 0;
}

echo "User credit: ".$credit."\n";
