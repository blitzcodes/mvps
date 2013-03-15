<?php

namespace BlitzMvp\Core\Data\lib;

if(!trait_exists('Crudable')) {
	trait Crudable {
		public function create() { }

		public function read() { }

		public function update() { }

		public function delete() { }
	}
}