<?php

/*
 * This file is part of Twig.
 *
 * (c) 2009 Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Autoloads Twig classes.
 *
 * @package twig
 * @author  Fabien Potencier <fabien@symfony.com>
 */
class Twig_Autoloader {
	static $twigClasses = array();

	/**
	 * Registers Twig_Autoloader as an SPL autoloader.
	 */
	public static function register() {
		ini_set('unserialize_callback_func', 'spl_autoload_call');
		spl_autoload_register(array(
			new self,
			'autoload'
		));
	}

	/**
	 * Handles autoloading of classes.
	 *
	 * @param string $class A class name.
	 */
	public static function autoload($class) {
		if(!self::$twigClasses[$class]) {
			self::$twigClasses[$class] = true;

			if(0 !== strpos($class, 'Twig')) {
				return false;
			}

			if(is_file($file = __DIR__ . '/../' . str_replace(array(
				'_',
				"\0"
			), array(
				'/',
				''
			), $class) . '.php')
			) {
				require_once($file);
				return true;
			}
		}
		return false;
	}
}

Twig_Autoloader::register();