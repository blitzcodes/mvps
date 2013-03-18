<?php

namespace BlitzMvp\Core\Presenter;

class Stage {
	/** @var \BlitzMvp\Core\Presenter\Stage|null */
	public static $inst = null;
	/** @var $router \BlitzMvp\Core\Router\Router|null */
	public $router = null;
	/** @var $view \Twig_Environment|null */
	public $view = null;
	/** @var $uri \BlitzMvp\Core\Presenter\Stage|null */
	public $presenter = null;
	/** @var array */
	public $renderedViews = array();

	/**
	 * @param \Twig_Environment $viewer
	 */
	public function __construct(\Twig_Environment $viewer) {
		self::$inst =& $this;

		// Register the autoload controls, stackable and does not interfere with Twig's
		$this->_registerAutoload();
		$this->router = new \BlitzMvp\Core\Router\Router();

		$this->view = $viewer;
		$this->renderPresenter();
	}

	/**
	 *
	 */
	private function  _registerAutoload() {
		spl_autoload_register(function ($namedClass) {
			static $classList = array();

			if(!$classList[$namedClass]) {
				$classList[$namedClass] = true;

				$namedClass = ltrim($namedClass, '\\');
				$classPath  = '';
				if($lastNsPos = strrpos($namedClass, '\\')) {
					$namespace  = LIB_ROOT . substr($namedClass, 0, $lastNsPos);
					$namedClass = substr($namedClass, $lastNsPos + 1);
					$classPath  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
				}
				$classPath .= str_replace('_', DIRECTORY_SEPARATOR, $namedClass) . '.php';

				if(is_file($classPath)) {
					require_once($classPath);

					return true;
				}
			}

			return false;
		});
	}

	/**
	 * @param string $route
	 * @param string $dir
	 * @param string $template
	 * @param string $baseTemplate
	 *
	 * @return mixed
	 */
	public function renderPresenter($route = '', $dir = '', $template = '', $baseTemplate = '') {
		$presenter             = new Presenter($route, $dir, $template, $baseTemplate);
		$this->renderedViews[] =& $presenter;

		return $presenter->render();
	}

	/**
	 * When do we want to render the final page? Once we know for sure we're all done here... Lights, Stage, Action!
	 * The final culmination of the resulting output, stored in the last possible array slot, is our page to display
	 */
	public function __destruct() {
		/** @var $lastPres \BlitzMvp\Core\Presenter\Presenter */
		//		dieToString($this->renderedViews);
		$lastPres = array_shift($this->renderedViews);
		print $lastPres->renderView();
	}
}