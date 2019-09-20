<?php

use Redcat\Request;
use Redcat\Routes;
use Redcat\View;

session_start();

// show me all the errors please
ini_set('log_errors', 1);
error_reporting(E_ALL);
ini_set('display_errors', 'stdout');

require_once 'autoload.php';

$view = new View(dirname(__DIR__) . '/public/pages');
$routes = new Routes($view);
$request = new Request();

$config = [];
$config['data_dir'] = dirname(__DIR__) . '/data';

if ($request->host() === 'redcat.local') {
    $view->setUrlBase('http://redcat.local');
} else {
    $view->setUrlBase('https://jeff.dog/csv');
    $routes->setServerDir('/csv');
}

/**
 * Request a global config value
 *
 * @return
 */
function config(string $key)
{
    global $config;

    return $config[$key];
}

/**
 * Global request function to access the global request var
 *
 * @return Request
 */
function request() : Request
{
    global $request;

    return $request;
}

/**
 * Global routes function to access the global routes var
 *
 * @return Routes
 */
function routes() : Routes
{
    global $routes;

    return $routes;
}

/**
 * Global view function to access the global view var
 *
 * @return View
 */
function view() : View
{
    global $view;

    return $view;
}
