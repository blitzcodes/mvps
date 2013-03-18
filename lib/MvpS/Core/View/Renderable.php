<?php

namespace BlitzMvp\Core\View;

trait Renderable {
	public function toString() {
		return toString($this);
	}

	public function dieToString() {
		die(toString($this));
	}
}

