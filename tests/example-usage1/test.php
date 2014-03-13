<?php

require 'vendor/autoload.php';

$ws = new Playsms\Webservices;

// edit this URL if you don't have local playSMS
// you may try to use http://playsms.org/trial/index.php?app=ws
// go to http://playsms.org/trial and register for username/password
// its a demo website, sms will not be sent to mobiles
// also make sure that username and password is correct
$ws->url = 'http://localhost/playsms/index.php?app=ws';
$ws->username = 'admin';
$ws->password = 'admin';

// get token from username and password
$get_token = $ws->getToken();
$response = $ws->getResponse();

if ($response->status == 'OK') {
	$token = $response->token;
} else {
	$token = '';
}

$error_string = @ ( $response->error_string ? $response->error_string : '' );

echo "Status: ".$response->status."\n";
echo "ERR: ".$response->error."\n";
echo "ERR_STR: ".$error_string."\n";
echo "Token: ".$token."\n";

// get user's credit
$ws->token = $token;
$ws->getCredit();
$response = $ws->getResponse();

if ($response->status == 'OK') {
	$credit = $response->credit;
} else {
	$credit = 0;
}

echo "User credit: ".$credit."\n";
