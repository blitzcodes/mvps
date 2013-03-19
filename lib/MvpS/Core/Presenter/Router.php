<?php

namespace MvpS\Core\Presenter;

class Router {
	use \MvpS\Core\View\Renderable;

	const DefaultBaseTemplate = 'base/base';
	const DefaultTemplate = 'main/main';
	const DefaultRoute    = 'home';

	public $queryRoute = array();
	public $fullRoute = '';
	public $currentRoute = '';
	public $finalRoute = '';
	public $fullRoutePath = '';
	public $fullRoutePathWithSubfolder = '';

	public function __construct() {
		// Determine the current page to be viewed, else default
		$this->fullRoute    = substr($_SERVER['QUERY_STRING'], 1);
		$this->queryRoute   = explode('/', $this->fullRoute);
		$this->currentRoute = $this->queryRoute[0] ? $this->queryRoute[0] : self::DefaultRoute;
		if(count($this->queryRoute))
			$this->finalRoute = array_pop($this->queryRoute);

		$fullPath                         = implode('/', $this->queryRoute);
		$this->fullRoutePath              = $this->_cleanPath("{$fullPath}/{$this->finalRoute}.php");
		$this->fullRoutePathWithSubfolder = $this->_cleanPath("{$this->fullRoute}/{$this->finalRoute}.php");
	}

	/**
	 * @param string $route
	 * @param string $dir
	 *
	 * @return string
	 */
	public function getPresenterRoute($route = '', $dir = '') {
		// Look into the current route path + final query var to see if there's a presenter there (i.e. /admin/login.php)
		$presenterPath = $this->fullRoutePath;
		if(is_file($presenterPath))
			return $presenterPath;
		//		var_dump("$presenterPath<br/>");

		// Next, look into the current route path + final query var & folder to see if there's a presenter there (i.e. /admin/login/login.php)
		$presenterPath = $this->fullRoutePathWithSubfolder;
		if(is_file($presenterPath))
			return $presenterPath;
		//		var_dump("$presenterPath<br/>");

		// If we don't have a route set and made it this far, assume the current route instead (which in the worst case is set to the default route constant)
		if(!$route)
			$route = $this->currentRoute;

		// Now attempt to look in the first logical place for the presentation, the assumed dir (regardless if blank)
		// from the working Presenters folder (i.e. '{home}.php', '{default}/{home}.php')
		$dir .= DIRECTORY_SEPARATOR;
		$presenterPath = $this->_cleanPath("{$dir}{$route}.php");
		if(is_file($presenterPath))
			return $presenterPath;

		// Next, look into the standard assumed path 'home/home.php', 'admin/admin.php' to leverage, and failing this,
		// the final fallback to select the default path
		$dir .= DIRECTORY_SEPARATOR . $route . DIRECTORY_SEPARATOR;
		$presenterPath = $this->_cleanPath("$dir{$route}.php");
		if(!is_file($presenterPath))
			$presenterPath = $this->defaultPresenterRoute();

		// If we're still missing even the default route at this point, somethings gone astray, cease functioning and find a resolution resolve
		if(!is_file($presenterPath))
			die("Default presenter missing!");

//		return array(str_replace('/\\\\',DIRECTORY_SEPARATOR, $presenterPath), str_replace('\\\\','',$dir));
		return $presenterPath;
	}

	/**
	 * @param        $path
	 * @param string $root
	 *
	 * @return string
	 */
	private function _cleanPath($path, $root = MVPS_PRESENTERS) {
		return str_replace(array(
			'//',
			'/.'
		), array(
			'/',
			'.'
		), $root . $path);
	}

	/**
	 * @return string
	 */
	private function  defaultPresenterRoute() {
		return $this->_cleanPath(self::DefaultRoute . DIRECTORY_SEPARATOR . self::DefaultRoute . ".php");
	}

	/**
	 * @param string $template
	 *
	 * @return string
	 */
	public function getViewRoute($template = '') {
		$templatePath = MVPS_VIEWS . "$template.twig";
		if(!is_file(MVPS_ROOT . $templatePath))
			$templatePath = MVPS_VIEWS . self::DefaultTemplate . ".twig";
		if(!is_file(MVPS_ROOT . $templatePath)) {
			var_dump($templatePath);
			die("Default template missing!");
		}

		//		var_dump("$templatePath<br/>");

		return $templatePath;
	}
}