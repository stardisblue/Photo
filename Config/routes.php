<?php


/**
 * Front office routes
 */
use Rave\Config\Config;

$router->get('/', ['Main' => 'index']);

$router->get('/photo', ['Photo' => 'index']);

$router->get('/tags', ['Tag' => 'displayAll']);

$router->get('/tag/:id:slug', ['Tag' => 'display'])->with('id','([0-9]{1,6})')->with('slug','-([-a-z0-9]+)?');

$router->post('/photo/like-:id', ['Photo' => 'like'])->with('id', '([0-9]{1,6})');

$router->get('/photo/:id:slug', ['Photo' => 'display'])->with('id', '([0-9]{1,6})')->with('slug','-([-a-z0-9]+)?');

$router->get('/contact', ['Contact' => 'index']);

$router->post('/contact', ['Contact' => 'index']);

$router->get('/search', ['Photo' => 'search']);

$router->post('/search', ['Photo' => 'search']);

$router->post('/comment/add-:id', ['Comment' => 'add'])->with('id', '([0-9]{1,6})');

/**
 * Back office routes
 */
$router->get('/admin', ['Admin' => 'index']);

$router->get('/admin/manage', ['Admin' => 'manage']);

$router->get('/admin/modification-success', ['Admin' => 'modificationSuccess']);


$router->get('/admin/account', ['Admin' => 'account']);

$router->post('/admin/account', ['Admin' => 'account']);


$router->post('/admin/gallery/add', ['Admin' => 'addGallery']);

$router->get('/admin/gallery/manage', ['Admin' => 'manageGallery']);

$router->get('/admin/gallery/delete-:id', ['Admin' => 'deleteGallery'])->with('id', '([0-9]{0,6})');


$router->get('/admin/comment/manage', ['Admin' => 'manageComment']);

$router->get('/admin/comment/update-:id', ['Admin' => 'updateComment'])->with('id', '([0-9]{0,6})');

$router->post('/admin/comment/update-:id', ['Admin' => 'updateComment'])->with('id', '([0-9]{0,6})');

$router->get('/admin/comment/delete-:id', ['Admin' => 'deleteComment'])->with('id', '([0-9]{0,6})');


$router->get('/admin/photo/add', ['Admin' => 'addPhoto']);

$router->post('/admin/photo/add', ['Admin' => 'addPhoto']);

$router->get('/admin/photo/manage', ['Admin' => 'managePhoto']);

$router->get('/admin/photo/delete-:id', ['Admin' => 'deletePhoto'])->with('id', '([0-9]{0,6})');

$router->get('/admin/photo/update-:id', ['Admin' => 'updatePhoto'])->with('id', '([0-9]{0,6})');

$router->post('/admin/photo/update-:id', ['Admin' => 'updatePhoto'])->with('id', '([0-9]{0,6})');


$router->get('/admin/wrong-login', ['Admin' => 'wrongLogin']);

$router->get('/admin/wrong-password', ['Admin' => 'wrongPassword']);


$router->get('/admin/login', ['Admin' => 'login']);

$router->post('/admin/login', ['Admin' => 'login']);

$router->get('/admin/logout', ['Admin' => 'logout']);

$router->get('/admin/logout-success', ['Admin' => 'logoutSuccess']);

$router->get('/admin/logout-error', ['Admin' => 'logoutError']);

/**
 * Error routes
 */
$router->get(Config::getError('404'), ['Error' => 'notFound']);

$router->get(Config::getError('403'), ['Error' => 'forbidden']);

$router->get(Config::getError('500'), ['Error' => 'internalServerError']);
