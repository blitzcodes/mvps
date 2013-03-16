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
	define("BLITZMVP_ROOT", LIB_ROOT . 'BlitzMvp/');
	require_once(BLITZMVP_ROOT.'inc.php');
}

// Fire it up ~ Goodness, gracious, great balls of fire!
$router = new \BlitzMvp\Core\Presenter\Presenter(new Twig_Environment(new Twig_Loader_Filesystem(BLITZMVP_ROOT . 'Views')));