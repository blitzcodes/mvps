<?php

namespace BlitzMvp\Models;

require_once(dirname(__FILE__) . '/../Core/Accounts/Account.php');

if(!class_exists('BlitzMvp\Models\User')) {
	class User {
		use \BlitzMvp\Core\Accounts\Account, \BlitzMvp\Core\Data\RESTful;

		public function __construct() {
		}

		public function guid() { return "This is my GUID: {$this->getGuid()}"; }
	}
}