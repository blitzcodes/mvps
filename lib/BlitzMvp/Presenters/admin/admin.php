<?php

/** @var $stage \BlitzMvp\Core\Presenter\Stage */

$output .= "<h1>Admin Panel!</h1>";

$u = new \BlitzMvp\Models\User();
if($u->checkLogin(array()))
	$output .= "<br/>" . $u->isAuthenticated();

$output .= "<br/>" . $u->guid();

$u->setGuid(2);

$output .= "<br/>" . $u->guid();
