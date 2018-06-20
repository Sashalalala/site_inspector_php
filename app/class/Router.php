<?php

class Router {

    private static $path;

    private static $routes;

    private static function setPath(){
        $uri= $_SERVER['REQUEST_URI'];
        $path = parse_url($uri)['path'];
        self::$path = $path;
        echo self::$path;
    }

    public static function getPath(){
        if(!self::$path){
            self::setPath();
        }
        return self::$path;
    }

    public static function autoload(){
        spl_autoload_register(function($className){
            if(file_exists(APP_DIR.'/Controllers/'. $className . '.php')){
                include APP_DIR.'/Controllers/'. $className . '.php';
            }
        });
    }

    public static function addRoute($path, $callBack){
        if($path === self::getPath()){
            $callBack();
        }
    }
}