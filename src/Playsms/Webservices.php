<?php

/*
 * The MIT License
 *
 * Copyright 2014 Anton Raharja <antonrd at gmail dot com>.
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

namespace Playsms;

/**
 * playSMS Webservices
 *
 * @author Anton Raharja
 */
class Webservices {

	// playSMS Webservices operation results

	private $webservices_url;
	private $response;
	private $data;
	private $status;
	private $error;
	private $error_string;


	// playSMS Webservices operation parameters

	public $url;
	public $token;
	public $username;
	public $password;
	public $operation;
	public $from;
	public $to;
	public $footer;
	public $nofooter;
	public $msg;
	public $schedule;
	public $type;
	public $unicode;
	public $queue;
	public $src;
	public $dst;
	public $datetime;
	public $smslog_id;
	public $last_smslog_id;
	public $count;
	public $keyword;


	/**
	 * Fetch content from URL
	 * @param string $query_string Webservices URL
	 */
	private function _Fetch() {
		$this->_setWebservicesUrl();
		$this->response = file_get_contents($this->getWebservicesUrl());
	}

	/**
	 * Process and populate class for results
	 */
	private function _Populate() {
		$this->data = json_decode($this->response);
		
		// getStatus() FALSE upon receiving status ERR and a non-zero error
		// else set as TRUE
		if (($this->data->status == 'ERR') && ((int) $this->data->error > 0)) {
			$this->status = FALSE;
		} else {
			$this->status = TRUE;
		}

		$this->error = ( (int) $this->data->error > 0 ? (int) $this->data->error : 0 );
		$this->error_string = $this->data->error_string;
	}

	/**
	 * Build a complete webservices URL
	 */
	private function _setWebservicesUrl() {
		$ws_url = $this->url.'&format=json';

		if ($this->token) {
			$ws_url .= '&h=' . $this->token;
		}

		if ($this->username) {
			$ws_url .= '&u=' . $this->username;
		}

		if ($this->password) {
			$ws_url .= '&p=' . $this->password;
		}

		if ($this->operation) {
			$ws_url .= '&op=' . $this->operation;
		}

		if ($this->from) {
			$ws_url .= '&from=' . urlencode($this->from);
		}

		if ($this->to) {
			$ws_url .= '&to=' . urlencode($this->to);
		}

		if ($this->footer) {
			$ws_url .= '&footer=' . urlencode($this->footer);
		}

		if ($this->nofooter) {
			$ws_url .= '&nofooter=' . $this->nofooter;
		}

		if ($this->msg) {
			$ws_url .= '&msg=' . urlencode($this->msg);
		}

		if ($this->schedule) {
			$ws_url .= '&schedule=' . $this->schedule;
		}

		if ($this->type) {
			$ws_url .= '&type=' . $this->type;
		}

		if ($this->unicode) {
			$ws_url .= '&unicode=' . $this->unicode;
		}

		if ($this->queue) {
			$ws_url .= '&queue=' . $this->queue;
		}

		if ($this->src) {
			$ws_url .= '&src=' . urlencode($this->src);
		}

		if ($this->dst) {
			$ws_url .= '&dst=' . urlencode($this->dst);
		}

		if ($this->datetime) {
			$ws_url .= '&dt=' . $this->datetime;
		}

		if ($this->smslog_id) {
			$ws_url .= '&smslog_id=' . $this->smslog_id;
		}

		if ($this->last_smslog_id) {
			$ws_url .= '&last=' . $this->last_smslog_id;
		}

		if ($this->count) {
			$ws_url .= '&c=' . $this->count;
		}

		if ($this->keyword) {
			$ws_url .= '&kwd=' . urlencode($this->keyword);
		}

		$this->webservices_url = $ws_url;
	}

	/**
	 * Get current webservices URL
	 * @return string
	 */
	public function getWebservicesUrl() {
		$this->_setWebservicesUrl();
		
		return $this->webservices_url;
	}

	/**
	 * Get raw response data
	 * @return string
	 */
	public function getResponse() {
		return $this->response;
	}

	/**
	 * Get JSON decoded data as an object
	 * @return object
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * Get status
	 * @return boolean
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * Get error code
	 * @return integer
	 */
	public function getError() {
		return $this->error;
	}

	/**
	 * Get error string
	 * @return string
	 */
	public function getErrorString() {
		return $this->error_string;
	}


	// playSMS Webservices operations

	/**
	 * Get webservices token. This operation can also be used as a login mechanism.
	 * @return mixed
	 */
	public function getToken() {
		$this->operation = 'get_token';
		$this->_Fetch();
		return $this->_Populate();
	}

	/**
	 * Set new webservices token. This operation can also be used as a change password/token mechanism.
	 * @return mixed
	 */
	public function setToken() {
		$this->operation = 'set_token';
		$this->_Fetch();
		return $this->_Populate();
	}

	/**
	 * Get user's credit
	 * @return mixed
	 */
	public function getCredit() {
		$this->operation = 'cr';
		$this->_Fetch();
		return $this->_Populate();
	}

	/**
	 * Send SMS to mobile numbers
	 * @return mixed
	 */
	public function sendSms() {
		$this->operation = 'pv';
		$this->_Fetch();
		return $this->_Populate();
	}

	/**
	 * Send SMS to groups
	 * @return mixed
	 */
	public function sendSmsToGroup() {
		$this->operation = 'bc';
		$this->_Fetch();
		return $this->_Populate();
	}

	/**
	 * Get list of outgoing SMS and delivery statuses
	 * @return mixed
	 */
	public function getOutgoing() {
		$this->operation = 'ds';
		$this->_Fetch();
		return $this->_Populate();
	}

	/**
	 * Get list of incoming SMS
	 * @return mixed
	 */
	public function getIncoming() {
		$this->operation = 'in';
		$this->_Fetch();
		return $this->_Populate();
	}

	/**
	 * Get list of SMS in user's inbox
	 * @return mixed
	 */
	public function getInbox() {
		$this->operation = 'ix';
		$this->_Fetch();
		return $this->_Populate();
	}

	/**
	 * Get list of SMS in Sandbox
	 * @return mixed
	 */
	public function getSandbox() {
		$this->operation = 'sx';
		$this->_Fetch();
		return $this->_Populate();
	}

	/**
	 * Get list of phonebook contacts
	 * @return mixed
	 */
	public function getPhonebookContacts() {
		$this->operation = 'get_contact';
		$this->_Fetch();
		return $this->_Populate();
	}

	/**
	 * Get list of phonebook groups
	 * @return mixed
	 */
	public function getPhonebookGroups() {
		$this->operation = 'get_contact_group';
		$this->_Fetch();
		return $this->_Populate();
	}

}
