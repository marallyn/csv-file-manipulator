<?php

namespace Redcat;

class View
{
    /**
     * The base directory of the views
     *
     * @var string
     */
    private $dir = '';

    /**
     * The base for making urls
     *
     * @var string
     */
    private $urlBase = '';

    /**
     * Save some values for later
     *
     * @param string $dir the directory where the pages are stored
     * @return void
     */
    public function __construct(string $dir)
    {
        $this->dir = $dir;
    }

    /**
     * Redirect to a different url
     *
     * @param string $route the route you want to redirect to
     * @return void
     */
    public function redirect(string $route)
    {
        header("Location: " . $this->url($route));
        exit();
    }

    /**
     * Shows a page
     *
     * @param string $page the page to show
     * @return void
     */
    public function show(string $page, array $args = [])
    {
        $file = $this->dir . '/' . $page . '.php';

        // turn any args into accessible variables for the html page
        foreach ($args as $arg => $value) {
            ${$arg} = $value;
        }
        
        if (is_file($file)) {
            include_once $file;
            
            return true;
        } else {
            return $this->show404();
        }
    }

    /**
     * Sets the base url for making urls
     *
     * @return void
     */
    public function setUrlBase(string $urlBase)
    {
        return $this->urlBase = $urlBase;
    }

    /**
     * Shows the error 404 page
     *
     * @return void
     */
    public function show404()
    {
        return $this->show('404');
    }

    /**
     * Create a url to the supplied route
     *
     * @param string $route the route to create a url for
     * @return string
     */
    public function url(string $route) : string
    {
        return $this->urlBase . '/' . \trim($route, '/');
    }
    
}//end Routes
