<?php

error_reporting(E_ALL ^ E_NOTICE);

define("LIB_ROOT", dirname(__FILE__) . DIRECTORY_SEPARATOR);

// Inclusion of vendor plugins and paths
{
	define("VENDOR_ROOT", LIB_ROOT . 'Vendor/');
	require_once(VENDOR_ROOT . 'Twig/Autoloader.php');
	require_once(VENDOR_ROOT . 'SwiftMailer/swift_required.php');
}

// Inclusion of the mvp presenter and paths
{
	define("BMVP_ROOT", LIB_ROOT . 'BlitzMvp/');
	require_once(BMVP_ROOT.'inc.php');
}

// Light it up ~ Goodness, gracious, great balls of fire!
$router = new \BlitzMvp\Core\Presenter\Stage(new Twig_Environment(new Twig_Loader_Filesystem(BMVP_ROOT)));