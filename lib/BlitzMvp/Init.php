<?php

namespace BlitzMvp;

error_reporting(1);

require_once(dirname(__FILE__) . '/Core/Data/RESTful.php');
require_once(dirname(__FILE__) . '/Models/User.php');

$u = new \BlitzMvp\Models\User();
if($u->checkLogin(array()))
	var_dump($u->isAuthenticated());

var_dump($u->guid());

print "Hello world!";
