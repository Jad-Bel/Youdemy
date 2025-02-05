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

                if (is_string($route['handler']) && strpos($route['handler'], '@') !== false) {
                    list($controller, $method) = explode('@', $route['handler']);
                    if (!class_exists($controller)) {
                        throw new \Exception("Controller class $controller not found. <br>");
                    }

                    $controllerInstance = new $controller();

                    if (!method_exists($controllerInstance, $method)) {
                        throw new \Exception("Method $method not found in controller $controller. <br>");
                    }

                    return call_user_func_array([$controllerInstance, $method], $matches);
                }

                if (is_callable($route['handler'])) {
                    return call_user_func_array($route['handler'], $matches);
                }

                throw new \Exception("Invalid handler for route: $path <br>");
            }
        }

        echo "404 Not Found";
    }
}