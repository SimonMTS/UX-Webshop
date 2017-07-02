<?php

    $controllers = array_diff(scandir("./controllers"), ['..', '.']);

    if ( in_array( ($controller.'_controller.php'), $controllers) )
    {
        require_once('controllers/' . $controller . '_controller.php');

        $controller = $controller.'Controller';
        $actions = get_class_methods( $controller );

        if ( in_array( $action, $actions ) )
        {
            $controller::beforeAction();
            $controller::{$action}($var);
        }
        else
        {
            Base::error_view(404);
        }
    }
    else
    {
        Base::error_view(404);
    }