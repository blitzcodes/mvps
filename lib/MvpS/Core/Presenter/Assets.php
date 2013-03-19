<?php

namespace MvpS\Core\Presenter;

class Assets {
	private $paths = array();

	public function addViewPath($path) {
		$this->addPath(MVPS_VIEWS_FULL. $path, REL_VIEWS . $path);
	}

	public function addPresenterPath($path) {
		$path = str_replace('/\\\\', DIRECTORY_SEPARATOR, $path);
		$this->addPath($path, REL_ROOT . str_replace('.php', '', str_replace(SITE_ROOT, '', $path)));
	}

	private function addPath($fsPath, $relPath) {
//		var_dump("$fsPath.css, $relPath.css");
//		var_dump(is_file("$fsPath.css"), is_file("$fsPath.js"));
		if(is_file("$fsPath.css"))
			$this->paths['css'] .= "<link rel='stylesheet' href='{$relPath}.css'/>";
		if(is_file("$fsPath.js"))
			$this->paths['js'] .= "<script src='{$relPath}.js'></script>";
//		var_dump(print_r($this->paths,true));
	}

	public function render() {
//		dieToString($this);
		return $this->paths;
	}
}

