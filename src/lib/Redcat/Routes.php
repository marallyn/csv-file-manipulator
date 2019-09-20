<?php

namespace Redcat;

use \Redcat\Pages;
use \Redcat\Request;

class Routes
{
    /**
     * The 'get' routes
     *
     * @var string
     */
    private $getRoutes = [];
    
    /**
     * The 'post' routes
     *
     * @var string
     */
    private $postRoutes = [];
    
    /**
     * The subdirectory on the server for calculating routes
     *
     * @var string
     */
    private $serverDir = '';
    
    /**
     * Save some values for later
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Add a route and handler function to the list of gettable routes.
     *
     * @param string $route the requested route
     * @param mixed $func the callback function; either a callable or string representing the function
     * @return void
     */
    public function get(string $route, $func)
    {
        $this->getRoutes[$this->serverDir . $route] = $func;
    }

    /**
     * Handles the requested route
     *
     * @param Request $request the request object
     * @return void
     */
    public function handle(Request $request)
    {
        $method = $request->method();
        $route = $request->route();

        // printf('<pre>Looking for %s via %s with parameters: %s</pre>', $route, $request->method(), \print_r($request->getParameters(), true));
        
        if ($method === 'GET') {
            if (isset($this->getRoutes[$route])) {
                $func = $this->getRoutes[$route];
                if (\is_callable($func)) {
                    \call_user_func($func, $request->getParameters());
                    return true;
                } else {
                    $parts = explode('@', $func);
                    $objName = __NAMESPACE__ . '\\' . $parts[0];
                    $obj = new $objName();
                    $obj->{$parts[1]}($request->getParameters());
                    return true;
                }
            }
        } elseif ($method === 'POST') {
            if (isset($this->postRoutes[$route])) {
                $func = $this->postRoutes[$route];
                if (\is_callable($func)) {
                    \call_user_func($func, $request->postParameters());
                    return true;
                } else {
                    $parts = explode('@', $func);
                    $objName = __NAMESPACE__ . '\\' . $parts[0];
                    $obj = new $objName();
                    $obj->{$parts[1]}($request->postParameters());
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Add a route and handler function to the list of posttable routes.
     *
     * @param string $route the requested route
     * @param mixed $func the callback function; either a callable or string representing the function
     * @return void
     */
    public function post(string $route, $func)
    {
        $this->postRoutes[$this->serverDir . $route] = $func;
    }

    /**
     * Sets the base directory for calculating the route
     *
     * @param string $subDir the server directory
     * @return void
     */
    public function setServerDir(string $subDir)
    {
        $this->serverDir = $subDir;
    }

}//end Routes
