<?php

/*
 * The MIT License
 *
 * Copyright 2014 dev.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

include '../src/Playsms/Webservices_Parameters.php';
include '../src/Playsms/Webservices.php';

$ws = new Playsms\Webservices();
$ws->url = 'http://localhost/playsms/index.php?app=ws';
$ws->username = 'admin';
$ws->password = 'admin';
$ws->getToken();
$response = $ws->getResponse();

echo "getToken:\n";
print_r($response)."\n";

if (is_object($response)) {
	if ($response->status == 'OK') {
		$ws->token = $response->token;
		$ws->count = 3;

		$ws->getOutgoing();
		$response = $ws->getResponse();
		echo "Outgoing SMS:\n";
		print_r($response)."\n";

		$ws->getIncoming();
		$response = $ws->getResponse();
		echo "Incoming SMS:\n";
		print_r($response)."\n";

		$ws->getInbox();
		$response = $ws->getResponse();
		echo "Inbox SMS:\n";
		print_r($response)."\n";

		$ws->getSandbox();
		$response = $ws->getResponse();
		echo "Sandbox SMS:\n";
		print_r($response)."\n";

	} else {
		echo "Auth failed\n";
	}
} else {
	echo "Failed\n";
}
