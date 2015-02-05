<?php
error_reporting(E_ALL ^ E_NOTICE);

require 'vendor/autoload.php';

$ws = new Playsms\Webservices();

include 'config.php';

// if you want to test with other username
// go to http://playsms.org/trial and register for username/password
// its a demo website, sms will not be sent to mobiles
$ws->url = $config['webservices_url'];
$ws->username = $config['webservices_username'];
$ws->token = $config['webservices_token'];

// get user's credit just to test authentication
$ws->getCredit();
$credit = ($ws->getStatus() ? $ws->getData()->credit : 'ERR');

if ($credit == 'ERR') {
	header('Location: error_auth.html');
	exit();
}

if ($credit <= 0) {
	header('Location: error_fund.html');
	exit();
}
