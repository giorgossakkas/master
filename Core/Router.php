<?php

namespace Core;

class Router
{
    protected $routes = [
      'GET' => [],
      'POST' => []

    ];

    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function direct($uri,$requestType)
    {

        $route = $this->getMatchingRoute($uri,$requestType);

        $controller = $this->routes[$requestType][$route];
        $controllerParts = explode ("@", $controller);

        $controllerName = 'App\Controllers\\'. $controllerParts[0];

        $params = $this->getParams($route,$uri);

        call_user_func_array([new $controllerName(), $controllerParts[1]], $params);

    }

    private function getMatchingRoute($uri,$requestType)
    {
        foreach ($this->routes[$requestType] as $route => $controller)
        {
            $regRoute = preg_replace('/\//', '\\/', $route);
            $regRoute = preg_replace('/\{([a-z]+)\}/', '.*', $regRoute);
            $regRoute = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $regRoute);
            $regRoute = '/^' . $regRoute . '$/i';

            if (preg_match($regRoute, $uri, $matches))
            {
                return $route;
            }
        }
    }

    private function getParams($route,$uri)
    {
        $routeParts = explode ("/", $route);
        $uriParts = explode ("/", $uri);
        $params = [];
        foreach ($routeParts as $key => $value)
        {
            if ($value !== $uriParts[$key])
            {
                $params[count($params)] = $uriParts[$key];
            }
        }

        return $params;
    }
}
