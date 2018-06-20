<?php

function render($state){
    $state = strpos($state, '.php')!==false ? $state : $state.'.php';
    $template = TEMPLATES_DIR .'/'. $state;
    if(file_exists($template)){
        include_once $template;
        return true;
    } else {
        return false;
    }
}
/**
 * @param $path string
 * @return string
 * Remove slash from url path if it exists
 */
function pathUnslash( $path ){
    $len = strlen($path);
    $pos = strpos($path,'/', $len - 1);
    if($path !=='/' && $pos === strlen($path) - 1){
        return substr($path, '0', $len-1);
    }
    return $path;
}

function render404Page(){
    header('HTTP/1.0 404 Not Found');
    render('parts/header');
    render('404');
    render('parts/footer');
}