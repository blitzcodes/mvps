<?php


error_reporting(E_ALL ^ E_NOTICE);

define("LIB_ROOT", dirname(__FILE__) . DIRECTORY_SEPARATOR);
define("MVPS_ROOT", LIB_ROOT . 'MvpS/');

define("ASSET_ROOT", SITE_ROOT . 'assets/');

define("MVPS_CORE", MVPS_ROOT . 'Core/');
define("MVPS_HELPERS", MVPS_CORE . 'Helpers/');
define("MVPS_PRESENTERS", MVPS_ROOT . 'Presenters/');
define("MVPS_VIEWS_FULL", MVPS_ROOT . 'Views/');
define("MVPS_VIEWS", 'Views/');

define("REL_ROOT", '/github/mvps/');
define("REL_VIEWS", REL_ROOT . 'lib/MvpS/' . MVPS_VIEWS);

require_once(MVPS_HELPERS . 'inc.php');
require_once(MVPS_CORE . 'Presenter/Stage.php');

// Light it up ~ Goodness, gracious, great balls of fire!
$stage = new \MvpS\Core\Presenter\Stage(new \Twig_Environment(new \Twig_Loader_Filesystem(MVPS_ROOT)));
