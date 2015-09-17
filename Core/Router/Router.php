<?php

namespace Rave\Core\Router;

use Rave\Core\Exception\RouterException;

class Router
{
    private $_url;

    private $_routes = [];
    private $_namedRoutes = [];

    public function __construct($url)
    {
        $this->_url = $url;
    }

    private function _add($method, $path, $callable, $name)
    {
        $route = new Route($path, $callable);
        $this->_routes[$method][] = $route;

        if (is_string($callable) && $name === null) {
            $name = $callable;
        }

        if ($name) {
            $this->_namedRoutes[$name] = $route;
        }

        return $route;
    }

    public function put($path, $callable, $name = null)
    {
        return $this->_add('PUT', $path, $callable, $name);
    }

    public function get($path, $callable, $name = null)
    {
        return $this->_add('GET', $path, $callable, $name);
    }

    public function post($path, $callable, $name = null)
    {
        return $this->_add('POST', $path, $callable, $name);
    }

    public function delete($path, $callable, $name = null)
    {
        return $this->_add('DELETE', $path, $callable, $name);
    }

    public function run()
    {
        if (!isset($this->_routes[$_SERVER['REQUEST_METHOD']])) {
            throw new RouterException('REQUEST_METHOD does not exists');
        }

        foreach ($this->_routes[$_SERVER['REQUEST_METHOD']] as $route)
        {
            if ($route->match($this->_url)) {
                return $route->call();
            }
        }

        throw new RouterException('No matching route');
    }

    public function url($name, $parameters = [])
    {
        if (!isset($this->_namedRoutes[$name])) {
            throw new RouterException('No route matching this name');
        }

        return $this->_namedRoutes[$name]->getUrl($parameters);
    }

}