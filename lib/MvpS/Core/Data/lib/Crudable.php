<?php

namespace MvpS\Core\Data\lib;

trait CRUDable {
	public function create($params = null) {
		$query = $params;
		return $this->query($query);
	}

	public function read($params = null) {
		$query = $params;
		return $this->query($query);
	}

	public function update($params = null) {
		$query = $params;
		return $this->query($query);
	}

	public function delete($params = null) {
		$query = $params;
		return $this->query($query);
	}

	protected function query($sql) {
		$result = false;
		return $result;
	}
}
