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
class Webservices extends Webservices_Parameters {

	/**
	 * This variable holds webservices response in JSON formatted string
	 */
	private $response;

	/**
	 * Fetch content from URL
	 * @param string $query_string Webservices URL
	 * @return string
	 */
	private function _Fetch() {
		$ws_url = $this->getWebservicesUrl();
		return file_get_contents($ws_url);
	}

	/**
	 * Get last response from last called method as an object
	 * @return mixed
	 */
	public function getResponse() {
		$response = $this->response;
		if ($this->response && ($this->format == 'json')) {
			$response = json_decode($this->response);
		}
		return $response;
	}

	/**
	 * Get webservices token. This operation can also be used as a login mechanism.
	 * @return string
	 */
	public function getToken() {
		$this->operation = 'get_token';
		$this->setWebservicesUrl();
		$this->response = $this->_Fetch();
		return $this->response;
	}

	/**
	 * Set new webservices token. This operation can also be used as a change password/token mechanism.
	 * @return string
	 */
	public function setToken() {
		$this->operation = 'set_token';
		$this->setWebservicesUrl();
		$this->response = $this->_Fetch();
		return $this->response;
	}

	/**
	 * Get user's credit
	 * @return string
	 */
	public function getCredit() {
		$this->operation = 'cr';
		$this->setWebservicesUrl();
		$this->response = $this->_Fetch();
		return $this->response;
	}

	/**
	 * Send SMS to mobile numbers
	 * @return string
	 */
	public function sendSms() {
		$this->operation = 'pv';
		$this->setWebservicesUrl();
		$this->response = $this->_Fetch();
		return $this->response;
	}

	/**
	 * Send SMS to groups
	 * @return string
	 */
	public function sendSmsToGroup() {
		$this->operation = 'bc';
		$this->setWebservicesUrl();
		$this->response = $this->_Fetch();
		return $this->response;
	}

	/**
	 * Get list of outgoing SMS and delivery statuses
	 * @return string
	 */
	public function getOutgoing() {
		$this->operation = 'ds';
		$this->setWebservicesUrl();
		$this->response = $this->_Fetch();
		return $this->response;
	}

	/**
	 * Get list of incoming SMS
	 * @return string
	 */
	public function getIncoming() {
		$this->operation = 'in';
		$this->setWebservicesUrl();
		$this->response = $this->_Fetch();
		return $this->response;
	}

	/**
	 * Get list of SMS in user's inbox
	 * @return string
	 */
	public function getInbox() {
		$this->operation = 'ix';
		$this->setWebservicesUrl();
		$this->response = $this->_Fetch();
		return $this->response;
	}

	/**
	 * Get list of SMS in Sandbox
	 * @return string
	 */
	public function getSandbox() {
		$this->operation = 'sx';
		$this->setWebservicesUrl();
		$this->response = $this->_Fetch();
		return $this->response;
	}

	/**
	 * Get list of phonebook contacts
	 * @return string
	 */
	public function getPhonebookContacts() {
		$this->operation = 'get_contact';
		$this->setWebservicesUrl();
		$this->response = $this->_Fetch();
		return $this->response;
	}

	/**
	 * Get list of phonebook groups
	 * @return string
	 */
	public function getPhonebookGroups() {
		$this->operation = 'get_contact_group';
		$this->setWebservicesUrl();
		$this->response = $this->_Fetch();
		return $this->response;
	}

}

/**
 * playSMS Webservices parameters
 *
 * @author Anton Raharja
 */
class Webservices_Parameters {
	private $webservices_url;

	public $url;
	public $token;
	public $username;
	public $password;
	public $operation;
	public $format;
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
	 * Get current webservices URL
	 * @return string
	 */
	public function getWebservicesUrl() {
		return $this->webservices_url;
	}

	/**
	 * Build a complete webservices URL
	 */
	public function setWebservicesUrl() {
		$ws_url = '';

		if ($this->url) {
			$ws_url .= $this->url;
		}

		if ($this->token) {
			$ws_url .= '&h='.$this->token;
		}

		if ($this->username) {
			$ws_url .= '&u='.$this->username;
		}

		if ($this->password) {
			$ws_url .= '&p='.$this->password;
		}

		if ($this->operation) {
			$ws_url .= '&op='.$this->operation;
		}

		if ($this->format) {
			$ws_url .= '&format='.$this->format;
		} else {
			$this->format = 'json';
			$ws_url .= '&format=json';

		}

		if ($this->from) {
			$ws_url .= '&from='.$this->from;
		}

		if ($this->to) {
			$ws_url .= '&to='.$this->to;
		}

		if ($this->footer) {
			$ws_url .= '&footer='.$this->footer;
		}

		if ($this->nofooter) {
			$ws_url .= '&nofooter='.$this->nofooter;
		}

		if ($this->msg) {
			$ws_url .= '&msg='.$this->msg;
		}

		if ($this->schedule) {
			$ws_url .= '&schedule='.$this->schedule;
		}

		if ($this->type) {
			$ws_url .= '&type='.$this->type;
		}

		if ($this->unicode) {
			$ws_url .= '&unicode='.$this->unicode;
		}

		if ($this->queue) {
			$ws_url .= '&queue='.$this->queue;
		}

		if ($this->src) {
			$ws_url .= '&src='.$this->src;
		}

		if ($this->dst) {
			$ws_url .= '&dst='.$this->dst;
		}

		if ($this->datetime) {
			$ws_url .= '&dt='.$this->datetime;
		}

		if ($this->smslog_id) {
			$ws_url .= '&smslog_id='.$this->smslog_id;
		}

		if ($this->last_smslog_id) {
			$ws_url .= '&last='.$this->last_smslog_id;
		}

		if ($this->count) {
			$ws_url .= '&c='.$this->count;
		}

		if ($this->keyword) {
			$ws_url .= '&kwd='.$this->keyword;
		}

		$this->webservices_url = $ws_url;
	}

}
