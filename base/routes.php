<?php

    $controllers = array_diff(scandir("./controllers"), ['..', '.']);

    if ( in_array( ($controller.'_controller.php'), $controllers) )
    {
        require_once('controllers/' . $controller . '_controller.php');

        $controller = $controller.'Controller';
        $actions = get_class_methods( $controller );

        if ( in_array( $action, $actions ) )
        {
            $controller::{$action}($var);
        }
        else
        {
            require_once('controllers/pages_controller.php');
            pagesController::error(404);
        }
    }
    else
    {
        require_once('controllers/pages_controller.php');
        pagesController::error(404);
    }