<?php

namespace MvpS\Core\Presenter;

class Presenter {
	public $path = '';
	public $output = '';
	/** @var $stage Stage */
	protected $stage = null;
	protected $route = '';
	protected $dir = '';
	public $template = '';
	protected $baseTemplate = '';
	/** @var $view \Assetic\Factory\AssetFactory|null */
	public $assets = null;

	public function __construct(&$stage, $route = '', $dir = '', $template = '', $baseTemplate = '') {
		$this->stage        = $stage;
		$this->route        = $route;
		$this->dir          = $dir;
		$this->template     = $template;
		$this->baseTemplate = $baseTemplate ? $baseTemplate : Router::DefaultBaseTemplate;

		$this->assets = new Assets();
	}

	/**
	 * @return string
	 */
	public function  render() {
		$this->path = $this->stage->router->getPresenterRoute($this->route, $this->dir);

		$this->assets->addPresenterPath($this->path);

		include($this->path);
		$output .= "<hr/>Current Route: " . $this->stage->router->toString();

		$this->output = $output;

		if($this->template)
			return $this->renderView();

		return $this;
	}

	public function  renderView($data = array()) {
		$data = array_merge($data, array('output' => $this->output));

		if($this->baseTemplate) {
			$basePath       = MVPS_VIEWS . "{$this->baseTemplate}.twig";
			$data['layout'] = $this->stage->view->loadTemplate($basePath);
			$this->assets->addViewPath($this->baseTemplate);
		}
		$this->assets->addViewPath($this->template);

		return $this->stage->view->render($this->stage->router->getViewRoute($this->template), $data);
	}
}