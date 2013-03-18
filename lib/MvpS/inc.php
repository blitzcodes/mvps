<?php

define("MVSP_CORE", MVSP_ROOT . 'Core/');
define("MVSP_HELPERS", MVSP_CORE . 'Helpers/');
define("BMVP_PRESENTERS", MVSP_ROOT . 'Presenters/');
define("BMVP_VIEWS", 'Views/');

require_once(BMVP_HELPERS . 'inc.php');
require_once(BMVP_CORE . 'Presenter/Stage.php');