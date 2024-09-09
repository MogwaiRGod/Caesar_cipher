<?php

namespace core;

define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
define('WEBROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));

$abstract_controller = ROOT.'back/core/AbstractController.php';

require($abstract_controller);