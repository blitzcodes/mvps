<?php

namespace BlitzMvp\Core\Router;

class Router {
	use \BlitzMvp\Core\View\Renderable;

	public $queryRoute = array();
	public $fullRoute = '';
	public $currentRoute = '';

	public function __construct() {
		// Determine the current page to be viewed, else default
		$this->fullRoute    = $_SERVER['QUERY_STRING'];
		$this->queryRoute   = explode('/', substr($this->fullRoute, 1));
		$this->currentRoute = $this->queryRoute[0] ? $this->queryRoute[0] : Settings::DefaultRoute;
	}

	public function  presenterPath($route = '', $dir = '') {
		// Are overriding the route, or utilizing the default?
		if(!$route)
			$route = $this->currentRoute;

		$dir .= DIRECTORY_SEPARATOR . $route . DIRECTORY_SEPARATOR;

		// Does the route we want even exist? If not, fall back on the default
		$presenterPath = BLITZMVP_PRES . "$dir{$route}.php";
		//		var_dump("$presenterPath<br/>");
		if(!is_file($presenterPath))
			$presenterPath =
				BLITZMVP_PRES . Settings::DefaultRoute . DIRECTORY_SEPARATOR . Settings::DefaultRoute . ".php";

		// If we're still missing even the default route, somethings gone astray, cease functioning and resolve
		if(!is_file($presenterPath))
			die("Default presenter missing!");

		return $presenterPath;
	}
}