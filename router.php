<?php
// app/router.php

class Router
{
    protected $routes = [];

    public function add($route, $method, $action)
    {
        $route = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $route);
        $this->routes[$route][$method] = $action;
    }

    public function dispatch($uri)
    {
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route => $methods) {
            if (preg_match("#^$route$#", $uri, $matches) && isset($methods[$method])) {
                array_shift($matches); // Eliminar el primer elemento que es la ruta completa
                $this->callAction($methods[$method], $matches);
                return;
            }
        }

        http_response_code(404);
        echo 'Page not found';
    }

    protected function callAction($action, $params = [])
    {
        list($controller, $method) = explode('@', $action);
        $controller = new $controller;
        call_user_func_array([$controller, $method], $params);
    }
}
