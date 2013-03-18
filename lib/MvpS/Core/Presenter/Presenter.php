<?php

namespace BlitzMvp\Core\Presenter;

class Presenter {
	public $path = '';
	public $output = '';
	protected $route = '';
	protected $dir = '';
	protected $template = '';
	protected $baseTemplate = 'base';

	public function __construct($route = '', $dir = '', $template = '', $baseTemplate = '') {
		$this->route    = $route;
		$this->dir      = $dir;
		$this->template = $template;
		if($baseTemplate)
			$this->baseTemplate = $baseTemplate;
	}

	/**
	 * @return string
	 */
	public function  render() {
		$this->path = Stage::$inst->router->getPresenterRoute($this->route, $this->dir);

		$stage =& Stage::$inst;

		//		var_dump($this->route);
		require_once($this->path);
		$output .= "<hr/>Current Route: " . $stage->router->toString();

		$this->output = $output;

		if($this->template)
			return $this->renderView();

		return $this->output;
	}

	/**
	 * @return string
	 */
	public function  renderView() {
		$data = array('output' => $this->output);
		if($this->baseTemplate) {
			$basePath       = MVSP_VIEWS . "{$this->baseTemplate}.twig";
			$data['layout'] = Stage::$inst->view->loadTemplate($basePath);
		}

		//		var_dump($basePath, $this->baseTemplate);
		//		dieToString($data);

		return Stage::$inst->view->render(Stage::$inst->router->getViewRoute($this->template), $data);
	}
}