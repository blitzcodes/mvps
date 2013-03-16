<?php

/** @var $presenter BlitzMvp\Core\Presenter\Presenter */
/** @var $view Twig_Environment */

$output .= $presenter->loadPresenter('account', 'home');

$u = new \BlitzMvp\Models\User();
if($u->checkLogin(array()))
	$output .= "<br/>" . $u->isAuthenticated();

$output .= "<br/>" . $u->guid();

$u->setGuid(2);

$output .= "<br/>" . $u->toString();

$output .= "<hr/>Current Route: " . $presenter->router->toString();

