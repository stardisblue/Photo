<?php

ini_set('display_errors', true);
ini_set('display_startup_errors', true);
error_reporting(-1);

session_start();

use Rave\Core\AutoLoader;
use Rave\Core\Error;
use Rave\Core\Exception\RouterException;
use Rave\Core\Router\Router;

/**
 * Some useful constants
 */
define('ROOT', __DIR__);

$webRoot = dirname(filter_input(INPUT_SERVER, 'SCRIPT_NAME'));

if ($webRoot === '/') {
    define('WEB_ROOT', null);
} else {
    define('WEB_ROOT', $webRoot);
}

/**
 * Include the autoloader
 */
require_once ROOT . '/Core/AutoLoader.php';

/**
 * Enable the autoloader
 */
AutoLoader::register();

/**
 * Instantiation of the Router object
 */
$router = new Router($_GET['url']);

require_once "Config/routes.php";

/**
 * Run the router. If an exception is caught, the user
 * will be redirected to a 404 error page.
 */
try {
    $router->run();
} catch (RouterException $exception) {
    Error::create($exception->getMessage(), 404);
}