<?php

function toString($o) {
	return "<pre>" . print_r($o, true) . "</pre>";
}

function dieToString($o) {
	die(toString($o));
}