<?php
include 'init.php';

$ws->to = $_POST['to'];
$ws->msg = $_POST['msg'];
$ws->sendSms();

if ($ws->getStatus()) {
	header('Location: success.html');
} else {
	header('Location: error_send.html');
}

exit();
