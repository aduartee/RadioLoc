<?php

namespace app\routes;

use Exception;
use app\Helpers\Request;
use app\Helpers\Uri;

class Router
{
    const CONTROLLER_NAMESPACE = 'app\\controllers';

    public static function load(string $controller, string $method)
    {
        $controllerNamespace = self::CONTROLLER_NAMESPACE . '\\' . $controller;
        try {
            if (!class_exists($controllerNamespace)) {
                throw new Exception("The Controller $controller no exists...");
            }

            $controllerInstace = new $controllerNamespace;

            if (!method_exists($controllerInstace, $method)) {
                throw new Exception("The Method $method no exists...");
            }

            $controllerInstace->$method();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public static function routes(): array
    {
        return [
            "get" => [
                "/" => fn() => self::load("HomeController", "index"),
                "customer" => fn() => self::load("CustomerController", "customers"),
                "equipments" => fn() => "EquipmentsController",
            ],
            "post" => [

            ],
        ];
    }

    public static function execute()
    {
        try {
            $routes = self::routes();
            $request = Request::get();
            $uri = Uri::get('path');

            error_log(var_dump($routes));
            error_log($request);
            error_log($uri);

            if (!isset($routes[$request])) {
                throw new Exception('The route no exists');
            }

            if (!array_key_exists($uri, $routes[$request])) {
                throw new Exception('The route no exists');
            }

            $router = $routes[$request][$uri];

            if (!is_callable($router)) {
                throw new Exception('The function is not callable');
            }

            $router();

        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }
}