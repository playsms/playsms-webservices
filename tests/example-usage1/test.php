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

if ($response->status == 'OK') {
	$token = $response->token;
} else {
	$token = '';
}

echo "Status: ".$response->status."\n";

if ($response->error) {
	echo "ERR: ".$response->error."\n";
	if ($response->error_string) {
		echo "ERR_STR: ".$error_string."\n";
	}
	exit();
}

echo "Token: ".$token."\n";

// get user's credit
unset($response); // discard previous response
$ws->token = $token;
$ws->getCredit();
$response = $ws->getResponse();

if ($response->status == 'OK') {
	$credit = $response->credit;
} else {
	$credit = 0;
}

echo "User credit: ".$credit."\n";

