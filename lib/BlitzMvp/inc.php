<?php

define("BMVP_CORE", BMVP_ROOT . 'Core/');
define("BMVP_HELPERS", BMVP_CORE . 'Helpers/');
define("BMVP_PRESENTERS", BMVP_ROOT . 'Presenters/');
define("BMVP_VIEWS", 'Views/');

require_once(BMVP_HELPERS . 'inc.php');
require_once(BMVP_CORE . 'Presenter/Stage.php');