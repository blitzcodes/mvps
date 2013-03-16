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
	public $template = 'Main/default';

	public function __construct(\Twig_Environment $viewer) {
		// Register the autoload controls, stackable and does not interfere with Twig's
		$this->_registerAutoload();
		$this->view = $viewer;

		$this->router = new \BlitzMvp\Core\Router\Router();
		$this->loadPresenter();
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

	public function loadPresenter($route = '', $dir = '') {
		$presenterPath = $this->router->presenterPath($route, $dir);

		// Include default globals for easy of access in presenters
		global $view, $presenter;
		$view      = $this->view;
		$presenter = $this;

		require_once($presenterPath);

		$this->output[] = $output;

		return $output;
	}

	public function renderPresenter($route = '', $dir = '', $template = '', $base = '') {
		$output = $this->loadPresenter($route, $dir);

		if($template)
			return $this->renderTemplate($template, $base);
	}

	// When do we want to render the final page? Once we know for sure we're all done here... Lights, Stage, Action!

	public function __destruct() {
		$this->_displayPage();
	}

	private function _displayTemplate() {
		//		dieToString($this->output);
		// The final culmination of the resulting output, stored in the last possible array slot, is our page to display
		print $this->renderTemplate(array_pop($this->output), true);
	}

	private function  renderTemplate($template, $base = '') {
		$data = array('output' => $output);
		if($includeBase)
			$data['base'] = $this->view->loadTemplate(BLITZMVP_VIEWS . "$base.twig");

		return $this->view->display(BLITZMVP_VIEWS . $this->$template . '.twig', $data);
	}
}