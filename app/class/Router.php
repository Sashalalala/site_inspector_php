<?php

class Router {

    private static $path;

    private static $routes;

    private static function setPath(){
        $uri= $_SERVER['REQUEST_URI'];
        $path = pathUnslash(parse_url($uri)['path']);
        self::$path = $path;
    }

    public static function getPath(){
        if(!self::$path){
            self::setPath();
        }
        return self::$path;
    }


    public static function forward($path, $callBack){
        if($path === self::getPath()){
            $callBack();
            return true;
        }
        return false;
    }

    public static function addRoute($path,  $callback){
        self::$routes[] = [$path, $callback];
    }

    public static function start(){
        if(!empty(self::$routes)){
            foreach (self::$routes as $route){
                try{
                    $isForward = self::forward($route[0], $route[1]);
                    if($isForward) return true;
                } catch (Exception $e){
                    echo 'Bad route - ' . implode(' : ', $route) ."\n". $e->getMessage();
                    return false;
                }
            }
        }
    }
}