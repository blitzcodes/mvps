<?php

namespace BlitzMvp\Core\Accounts\lib;

trait Authentication {
	private $_isAuthenticated = false;

	protected function login($params) {
		if($logInSuccessful || is_array($params))
			$this->_isAuthenticated = true;

		return $this->_isAuthenticated;
	}

	public function logout() {
		$this->_isAuthenticated = false;
	}

	public function isAuthenticated() { return $this->_isAuthenticated; }
}
