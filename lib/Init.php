<?php

use Assetic\AssetManager;
use Assetic\Extension\Twig;
use Assetic\Factory\AssetFactory;
use Assetic\Factory\Worker\CacheBustingWorker;
use Assetic\Filter\GoogleClosure;
use Assetic\FilterManager;
use Assetic\Filter\Yui;

error_reporting(E_ALL ^ E_NOTICE);

define("LIB_ROOT", dirname(__FILE__) . DIRECTORY_SEPARATOR);
define("MVPS_ROOT", LIB_ROOT . 'MvpS/');
require_once(MVPS_ROOT . 'inc.php');

$am = new AssetManager();
//$am->set('jquery', new FileAsset('/path/to/jquery.js'));
//$am->set('base_css', new GlobAsset('/path/to/css/*'));

//$am->set('my_plugin', new AssetCollection(array(
//	new AssetReference($am, 'jquery'),
//	new FileAsset('/path/to/jquery.plugin.js'),
//)));

$fm = new FilterManager();
//$fm->set('less', new LessFilter('');
//$fm->set('?yui_css', new Yui\CssCompressorFilter('/path/to/yuicompressor.jar'));

//$css = $assetFactory->createAsset(array(
//	'@reset',         // load the asset manager's "reset" asset
//	'css/src/*.scss', // load every scss files from "/path/to/asset/directory/css/src/"
//), array(
//	'scss',           // filter through the filter manager's "scss" filter
//	'?yui_css',       // don't use this filter in debug mode
//));
//
//echo $css->dump();

$fm->set('google_css', new GoogleClosure\CompilerJarFilter(LIB_ROOT . 'googlec.jar'));
//$fm->set('gcss', new GoogleClosure\CompilerApiFilter());
//$fm->set('css_min',new Assetic\Filter\CssMinFilter());
//$fm->set('css_rewrite',new Assetic\Filter\CssRewriteFilter());

$fm->set('yui_css', new Yui\CssCompressorFilter(LIB_ROOT.'yuic.jar'));

$assetFactory = new AssetFactory(ASSET_ROOT);
$assetFactory->setAssetManager($am);
$assetFactory->setFilterManager($fm);
//$assetFactory->setDebug(true);
//$assetFactory->addWorker(new CacheBustingWorker(CacheBustingWorker::STRATEGY_CONTENT));

$css = $assetFactory->createAsset(array(
//	'@reset',         // load the asset manager's "reset" asset
	'css/*',
	// load every scss files from "/path/to/asset/directory/css/src/"
), array(
	//	'scss',           // filter through the filter manager's "scss" filter
	'google_css',
	// don't use this filter in debug mode
));

die($css->dump());

//$css = $assetFactory->createAsset(array(
//	'@reset',         // load the asset manager's "reset" asset
//	'css/src/*.scss', // load every scss files from "/path/to/asset/directory/css/src/"
//), array(
//	'scss',           // filter through the filter manager's "scss" filter
//	'?yui_css',       // don't use this filter in debug mode
//));
//
//echo $css->dump();

$twig = new \Twig_Environment(new \Twig_Loader_Filesystem(MVPS_ROOT));
//require_once(SITE_ROOT . 'vendor/kriswallsmith/assetic/src/Assetic/Extension/Twig/AsseticExtension.php');
//$twig->addExtension(new AsseticExtension($assetFactory, $debug));

// Light it up ~ Goodness, gracious, great balls of fire!
$router = new \MvpS\Core\Presenter\Stage($twig, $assetFactory);