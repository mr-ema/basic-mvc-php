<?php
// PHP 8.0
// * Auto load classes

require dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * * Demo Router
 * * to add a route you should use 'get | post | delete | put'
 * * this router is no 100% secure
 */
$router = new Core\Router();

$router -> get('/', 'Home');
$router -> get('/about', 'About');

$router -> render( htmlspecialchars($_SERVER["REQUEST_URI"]) );

