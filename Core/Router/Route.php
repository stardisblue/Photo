<?php

namespace Rave\Core\Router;

class Route
{
    private $_path;
    private $_callable;

    private $_matches = [];
    private $_parameters = [];

    const MATCH_INDEX = 1;
    const METHOD_INDEX = 1;
    const CONTROLLER_INDEX = 0;

    public function __construct($path, $callable)
    {
        $this->_path = trim($path, '/');
        $this->_callable = $callable;
    }

    private function _parameterMatch($match)
    {
        if (isset($this->_parameters[$match[self::MATCH_INDEX]])) {
            return '(' . $this->_parameters[$match[self::MATCH_INDEX]] . ')';
        }

        return '([^/]+)';
    }

    public function match($url)
    {
        $url = trim($url, '/');
        $path = preg_replace_callback('#:([\w]+)#', [$this, '_parameterMatch'], $this->_path);

        if (!preg_match('#^' . $path . '$#i', $url, $matches)) {
            return false;
        }

        array_shift($matches);

        $this->_matches = $matches;

        return true;
    }

    public function call()
    {
        if (is_string($this->_callable)) {
            $parameters = explode('#', $this->_callable);

            $method = $parameters[self::METHOD_INDEX];
            $class = 'Rave\\Application\\Controller\\' . $parameters[self::CONTROLLER_INDEX];

            $controller = new $class();

            return call_user_func_array([$controller, $method], $this->_matches);
        } else {
            return call_user_func_array($this->_callable, $this->_matches);
        }
    }

    public function with($parameter, $regex)
    {
        $this->_parameters[$parameter] = str_replace('(', '(?:', $regex);
        return $this;
    }

    public function getUrl($parameters)
    {
        $path = $this->_path;

        foreach ($parameters as $key => $value)
        {
            $path = str_replace(':' . $key, $value, $path);
        }

        return $path;
    }

}