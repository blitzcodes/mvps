<?php

namespace MvpS\Core\Data;

trait RESTful {
	use \MvpS\Core\Data\lib\Crudable;

	// Read
	public function  get($params = null) {
		$query = $this->read($params);
		return $query;
	}

	// Create
	public function  post($params = null) {
		$query = $this->create($params);
		return $query;
	}

	// Update
	public function  put($params = null) {
		$query = $this->update($params);
		return $query;
	}

	// Delete
//	public function  delete($params = null) {
//		$query = $this->delete($params);
//		return $query;
//	}

	// Json output
	public function  toJson() { }

	// Html output
	public function  toHtml() { }
}
