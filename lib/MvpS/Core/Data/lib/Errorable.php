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
		else if(is_subclass_of($exception, 'Exception'))
			throw $exception;
		else
			throw new \Exception("An invalid use of the throws exception method has been used, please resolve.");
	}
}
