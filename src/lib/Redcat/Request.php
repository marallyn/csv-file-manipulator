<?php

namespace Redcat;

class Request
{
    /**
     * The get parameters
     *
     * @var array
     */
    private $getParameters = [];
    
    /**
     * The post parameters
     *
     * @var array
     */
    private $posttParameters = [];
    
    /**
     * The requested route
     *
     * @var string
     */
    private $route = [];
    
    /**
     * Save some values for later
     *
     * @return void
     */
    public function __construct()
    {
        $parts = \explode('?', $_SERVER['REQUEST_URI']);
        $this->route = $parts[0];
        if (count($parts) > 1) {
            $a = \array_map(
                function ($parm) {
                    return  \explode('=', $parm);
                },
                \explode('&', \urldecode($parts[1]))
            );
            // $a is an array of arrays of parameter and values
            // we want to turn it into an associative array of paramter => value
            foreach ($a as $arr) {
                $this->getParameters[$arr[0]] = $arr[1];
            }
        }

        $this->postParameters = $_POST;
    }

    /**
     * Add a route and handler function to the list of gettable routes.
     *
     * @param string $route the requested route
     * @param callable $func the callback function
     * @return void
     */
    public function get(string $route, callable $func)
    {
        $this->getRoutes[$route] = $func;
    }

    /**
     * Returns the requested parameters
     *
     * @return string|array
     */
    public function getParameters(string $key = '')
    {
        if (empty($key)) {
            return $this->getParameters;
        } elseif (isset($this->getParameters[$key])) {
            return $this->getParameters[$key];
        } else {
            return '';
        }
    }

    /**
     * Returns the http host
     *
     * @return string
     */
    public function host() : string
    {
        return $_SERVER['HTTP_HOST'];
    }

    /**
     * Returns the method
     *
     * @return string
     */
    public function method() : string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Returns the parameters found in the post request
     *
     * @return string|array
     */
    public function postParameters(string $key = '')
    {
        if (empty($key)) {
            return $this->postParameters;
        } elseif (isset($this->postParameters[$key])) {
            return $this->postParameters[$key];
        } else {
            return '';
        }
    }

    /**
     * Returns the requested route
     *
     * @return void
     */
    public function route()
    {
        return $this->route;
    }

    /**
     * Returns the $_SERVER array
     *
     * @return void
     */
    public function server() : array
    {
        return $_SERVER;
    }
}//end Routes
