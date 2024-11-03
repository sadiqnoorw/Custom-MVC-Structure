<?php

namespace App;
use App\Exception\RouteNotFoundException;

class Router
{
   
    private array $routes = [];
    public function register(string $route, callable|array $action, string $postType)
    {
        $this->routes[$postType][$route] = $action;
        return $this;
    }

    public function get(string $route, callable|array $action)
    {
        return $this->register($route, $action, 'get');

    }

    public function post(string $route, callable|array $action)
    {
        return $this->register($route, $action, 'post');

    }
    public function routes(): array
    {
        return $this->routes;
    }

    public function resolve($requestUri, string $postType)
    {
        $action = $this->routes[$postType][$requestUri] ?? null;
        if (!$action) {
            throw new RouteNotFoundException();
        }

        if(is_callable($action)) {
            return call_user_func($action);
        }
        if(is_array($action)) 
        {
            [$class, $method] = $action;  

            if(class_exists($class)) 
            { 
                
                $class = new $class();
                if(method_exists($class, $method)) {
                   
                    return call_user_func_array([$class, $method], []);
                } else {
                    throw new \App\Exception\MethodNotFoundException();
                }
            }else {
                throw new \App\Exception\ClassNotFoundException();
            }
        }
        throw new \App\Exception\RouteNotFoundException();

    }
}