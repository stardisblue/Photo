<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

session_start();

use Rave\Core\Error;
use Rave\Core\Autoloader;
use Rave\Core\Router\Router;
use Rave\Core\Exception\RouterException;

/**
 * Some useful constants
 */
define('ROOT', __DIR__);
define('WEB_ROOT', dirname(filter_input(INPUT_SERVER, 'SCRIPT_NAME')));

/**
 * Include the autoloader class
 */
require_once ROOT . '/Core/Autoloader.php';

/**
 * Enable the autoloader
 */
Autoloader::register();

/**
 * Instantiation of the Router object
 */
$router = new Router($_GET['url']);

/**
 * Front office routes
 */
$router->get('/', 'Main#index');

$router->get('/photo', 'Photo#index');

$router->post('/photo-like-:id', 'Photo#like')->with('id', '([0-9]{1,6})');

$router->get('/photo-display-:id', 'Photo#display')->with('id', '([0-9]{1,6})');

$router->get('/contact', 'Contact#index');

$router->post('/contact', 'Contact#index');

$router->get('/search', 'Photo#search');

$router->post('/search', 'Photo#search');

$router->post('/comment-add-:id', 'Comment#add')->with('id', '([0-9]{1,6})');


/**
 * Back office routes
 */
$router->get('/admin', 'Admin#index');

$router->get('/admin-login', 'Admin#login');

$router->post('/admin-login', 'Admin#login');

$router->get('/admin-manage', 'Admin#manage');

$router->get('/admin-account', 'Admin#account');

$router->post('/admin-account', 'Admin#account');

$router->get('/admin-logout', 'Admin#logout');

$router->get('/admin-add-photo', 'Admin#addPhoto');

$router->post('/admin-add-photo', 'Admin#addPhoto');

$router->get('/admin-manage-photo', 'Admin#managePhoto');

$router->get('/admin-manage-comment', 'Admin#manageComment');

$router->get('/admin-delete-photo-:id', 'Admin#deletePhoto')->with('id', '([0-9]{0,6})');

$router->get('/admin-delete-comment-:id', 'Admin#deleteComment')->with('id', '([0-9]{0,6})');

$router->get('/admin-update-photo-:id', 'Admin#updatePhoto')->with('id', '([0-9]{0,6})');

$router->post('/admin-update-photo-:id', 'Admin#updatePhoto')->with('id', '([0-9]{0,6})');

$router->get('/admin-update-comment-:id', 'Admin#updateComment')->with('id', '([0-9]{0,6})');

$router->post('/admin-update-comment-:id', 'Admin#updateComment')->with('id', '([0-9]{0,6})');

$router->get('/admin-wrong-login', 'Admin#wrongLogin');

$router->get('/admin-wrong-password', 'Admin#wrongPassword');

$router->get('/admin-logout-success', 'Admin#logoutSuccess');

$router->get('/admin-logout-error', 'Admin#logoutError');

$router->get('/admin-modification-success', 'Admin#modificationSuccess');

/**
 * Error routes
 */
$router->get('/not-found', 'Error#notFound');

$router->get('/forbidden', 'Error#forbidden');

$router->get('/internal-server-error', 'Error#internalServerError');

/**
 * Run the router. If an exception is caught, the user
 * will be redirected to a 404 error page.
 */
try {
    $router->run();
} catch (RouterException $exception) {
    Error::create($exception->getMessage(), '404');
}