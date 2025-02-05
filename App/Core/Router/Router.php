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

                // Handle controller@method syntax
                if (is_string($route['handler']) && strpos($route['handler'], '@') !== false) {
                    list($controller, $method) = explode('@', $route['handler']);
                    // Check if the controller class exists
                    if (!class_exists($controller)) {
                        throw new \Exception("Controller class $controller not found. <br>");
                    }

                    // Instantiate the controller
                    $controllerInstance = new $controller();

                    // Check if the method exists in the controller
                    if (!method_exists($controllerInstance, $method)) {
                        throw new \Exception("Method $method not found in controller $controller. <br>");
                    }

                    // Call the controller method with the matched parameters
                    return call_user_func_array([$controllerInstance, $method], $matches);
                }

                // Handle callable functions
                if (is_callable($route['handler'])) {
                    return call_user_func_array($route['handler'], $matches);
                }

                throw new \Exception("Invalid handler for route: $path <br>");
            }
        }

        // No matching route found
        echo "404 Not Found";
    }
}