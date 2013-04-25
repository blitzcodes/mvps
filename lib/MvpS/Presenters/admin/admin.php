<?php

/** @var $stage \MvpS\Core\Presenter\Stage */
/** @var $this \MvpS\Core\Presenter\Presenter */
$this->template = 'admin/admin';

$output .= "<h1>Admin Panel!</h1>";

$u = new \MvpS\Models\User();
if($u->checkLogin(array()))
	$output .= "<br/>" . $u->isAuthenticated();

$output .= "<br/>" . $u->guid();

$u->setGuid(2);

$output .= "<br/>" . $u->guid();
