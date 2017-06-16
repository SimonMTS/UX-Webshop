<?php
    require_once('base/config.php');
    require_once('base/classes.php');

    session_start();

    $var = explode('/', str_replace($GLOBALS['config']['base_url'], '',Base::Curl()) );

    if (isset($var[0]) && isset($var[1])) {
        $controller = $var[0];
        $action     = $var[1];
    } else {
        $controller = $config['landing']['controller'];
        $action     = $config['landing']['action'];
    }
    
    require_once('base/routes.php');
?>
