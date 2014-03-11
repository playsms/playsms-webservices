<?php

require 'vendor/autoload.php';

$ws = new Playsms\Webservices;

// edit this URL if you don't have local playSMS
// you may try to use http://playsms.org/trial/index.php?app=ws
// go to http://playsms.org/trial and register for username/password
// its a demo website, sms will not be sent to mobiles
$ws->url = 'http://localhost/playsms/index.php?app=ws';

$ws->username = 'admin';
$ws->password = 'admin';
$ws->getToken();
$response = $ws->getResponse();

print_r($response);
