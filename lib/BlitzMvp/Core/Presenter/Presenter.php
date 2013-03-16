<?php

namespace BlitzMvp\Core\Presenter;

class Presenter {
	/** @var $router \BlitzMvp\Core\Router\Router */
	public $router = NULL;
	/** @var $view \Twig_Environment */
	public $view = NULL;
	/** @var $uri \BlitzMvp\Core\Presenter\Presenter */
	public $presenter = NULL;
	public $output = array();

	public function __construct(\Twig_Environment $viewer) {
		// Register the autoload controls, stackable and does not interfere with Twig's
		$this->_registerAutoload();
		$this->view = $viewer;

		$this->router = new \BlitzMvp\Core\Router\Router();
		$this->renderPresenter();
	}

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

	public function renderPresenter($route = '', $dir = '') {
		$presenterPath = $this->router->presenterPath($route, $dir);

		// Include default globals for easy of access in presenters
		global $view, $presenter;
		$view      = $this->view;
		$presenter = $this;

		require_once($presenterPath);

		$this->output[] = $output;

		return $output;
	}

	public function __destruct() {
		$this->renderPage();
	}

	public function renderPage() {
		//		dieToString($this->output);
		// The final culmination of the resulting output, stored in the last possible array slot, is our page to display
		$output = array_pop($this->output);

		$base = $this->view->loadTemplate('base.twig');
		$this->view->display('Main/default.twig', array(
			'layout' => $base,
			'output' => $output
		));
	}
}