<?php

namespace BlitzMvp\Core\Data;

require_once(dirname(__FILE__).'/Crudable.php');

if(!trait_exists('RESTful')) {
	trait RESTful {
		use \BlitzMvp\Core\Data\lib\Crudable;

		public function  get() { }

		public function  post() { }

		public function  json() { }

		public function  html() { }
	}
}