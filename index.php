<?php

/**
 * Front Controller
 */

// General settings
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

session_start();

// Files connection system
define('ROOT', dirname(__FILE__));
define('SITE_NAME', 'CandyBobber');
define('SEP', ' | ');

require_once ROOT . '/components/Autoload.php';

// Call Router
$router = new Router();
$router->run();
