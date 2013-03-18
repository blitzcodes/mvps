<?php

error_reporting(E_ALL ^ E_NOTICE);

define("LIB_ROOT", dirname(__FILE__) . DIRECTORY_SEPARATOR);
define("MVSP_ROOT", LIB_ROOT . 'MvpS/');
require_once(MVSP_ROOT . 'inc.php');

// Light it up ~ Goodness, gracious, great balls of fire!
$router = new \BlitzMvp\Core\Presenter\Stage(new \Twig_Environment(new \Twig_Loader_Filesystem(MVSP_ROOT)));