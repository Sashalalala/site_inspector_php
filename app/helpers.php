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