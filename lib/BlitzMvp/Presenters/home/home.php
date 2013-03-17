<?php

/** @var $stage \BlitzMvp\Core\Presenter\Stage */
//$output .= $stage->renderPresenter('account', 'home');

$u = new \BlitzMvp\Models\User();
if($u->checkLogin(array()))
	$output .= "<br/>" . $u->isAuthenticated();

$output .= "<br/>" . $u->guid();

$u->setGuid(2);

$output .= "<br/>" . $u->toString();
