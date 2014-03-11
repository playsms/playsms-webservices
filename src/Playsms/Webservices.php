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
		$object = '';
		if ($this->response && (! $this->format || $this->format == 'json')) {
			$object = json_decode($this->response);
		}
		return $object;
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

}
