<?php
    require_once('base/config.php');
    require_once('base/classes.php');

    if ( $GLOBALS['config']['custom_errors'] ) {
        register_shutdown_function('Base::Error');
        set_error_handler('Base::Error');
        set_exception_handler('Base::Error');
        ini_set( "display_errors", "off" );
        error_reporting( E_ALL );
    }

    session_start();

    $var = explode('/', str_replace($GLOBALS['config']['base_url'], '',Base::Curl()) );

    if ( isset($var[0]) && !empty($var[0]) && !isset($var[1]) ) {
        $var[1] = 'overview';
    }

    if (isset($var[0]) && isset($var[1])) {
        $controller = $var[0];
        $action     = $var[1];
    } else {
        $controller = $config['landing']['controller'];
        $action     = $config['landing']['action'];
    }
    
    require_once('base/routes.php');