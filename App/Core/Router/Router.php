<?php

namespace App\Core\Router;

class Router 
{
    private static $routes = [];

    public static function add($route, $controller, $method)
    {
        self::$routes[$route] = ['controller' => $controller, 'method' => $method];
    }

    public static function dispatch($url) 
    {
        $url = trim($url, '/');

        if (isset(self::$routes[$url])) {
            $controllerClass = 'Controllers\\' . self::$routes[$url]['controller'];
            $method = self::$routes[$url]['method'];

            if (class_exists($controllerClass)) {
                $controller = new $controllerClass;
                if (method_exists($controller, $method)) {
                    $controller->$method();
                } else {
                    echo "Method '$method' not found in '$controllerClass'.";
                } 
            } else {
                echo "COntroller '$controllerClass' not found.";
            } 
        } else {
            echo "404 - Page Not Found!";
        }
    }
}