<?php
include 'init.php';

$ws->to = $_POST['to'];
$ws->msg = $_POST['msg'];
$ws->sendSms();

header('Location: success.html');
exit();
