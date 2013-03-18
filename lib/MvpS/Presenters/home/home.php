<?php

/** @var $stage \MvpS\Core\Presenter\Stage */
//$output .= $stage->renderPresenter('account', 'home');

$u = new \MvpS\Models\User();
if($u->checkLogin(array()))
	$output .= "<br/>" . $u->isAuthenticated();

$output .= "<br/>" . $u->guid();

$u->setGuid(2);

$output .= "<br/>" . $u->toString();

$output .= '<img src="assets/img/sample.png"/>';