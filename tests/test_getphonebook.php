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

	$ws->token = $ws->getData()->token;
	$ws->keyword = 'an';
	$ws->count = 3;

	echo "Contacts:\n";
	$ws->getPhonebookContacts();
	print_r($ws->getData()) . "\n";

	echo "Groups:\n";
	$ws->getPhonebookContacts();
	print_r($ws->getData()) . "\n";

} else {
	echo "Error code: " . $ws->getError() . "\n";
	echo "Error string: " . $ws->getErrorString() . "\n";
}

echo "\n";
