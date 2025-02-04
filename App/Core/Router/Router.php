<?php

namespace App\Core\Router;

class Router {
    private $routes = [];

    public function add($path, $handler) {
        $this->routes[] = [
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function dispatch($path) {

        foreach ($this->routes as $route) {
            $pattern = preg_replace('/\{(\w+)\}/', '([^/]+)', $route['path']);
            if (preg_match("#^$pattern$#", $path, $matches)) {
                array_shift($matches);
                return call_user_func_array($route['handler'], $matches);
            }
        }

        echo "404 Not Found";
    }
}