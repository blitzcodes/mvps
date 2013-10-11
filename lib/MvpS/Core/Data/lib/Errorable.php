<?php

namespace MvpS\Core\Data\lib;

trait Errorable {
	/**
	 * @param string|\Exception $exception
	 * @throws \Exception
	 */
	public function throws($exception) {
		if(is_string($exception))
			throw new \Exception($exception);
		else if(get_class($exception) == 'Exception')
			throw $exception;
	}
}
