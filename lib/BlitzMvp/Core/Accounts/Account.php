<?php

namespace BlitzMvp\Core\Accounts;

require_once(dirname(__FILE__) . '/Authentication.php');

if(!trait_exists('Account')) {

	trait Account {
		use \BlitzMvp\Core\Accounts\lib\Authentication;

		private $_guid;

		public function checkLogin($params) {
			if($this->login($params))
				$this->setGuid(1);

			return $this->_guid;
		}

		public function setGuid($newGuid) {
			$this->_guid = $newGuid;
			return $this->_guid;
		}

		protected function getGuid() { return $this->_guid; }
	}
}