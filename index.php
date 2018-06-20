<?php

/*
 * define constants
 */
define('ROOT_DIR', dirname(__FILE__));
define('ROOT_URL', (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/');
define('APP_DIR', dirname(__FILE__).'/app');
define('CLASS_DIR', APP_DIR.'/class');
define('TEMPLATES_DIR', APP_DIR . '/templates');
define('ASSETS_URL', ROOT_URL.'app/public/assets');



/*
 * Autoload classes
 */
spl_autoload_register(function($className){
    $className = str_replace('_', '/', $className);
    $classFile = CLASS_DIR.'/'.$className.'.php';
    $controllerFile = APP_DIR . '/controllers/'.$className.'.php';
    if(file_exists($classFile)){
        include $classFile;
        return;
    }
    if (file_exists($controllerFile)){
        include $controllerFile;
        return ;
    }
    return;
});

/*
 *  includes
 */
require APP_DIR.'/helpers.php';

Router::addRoute('/', array('MainCtrl','init'));
Router::addRoute('/inspect', 'InspectCtrl::init');

$isForward = Router::start();

if(!$isForward){
    render404Page();
}

exit;




