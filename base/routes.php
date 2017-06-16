<?php

    $controllers = array_diff(scandir("./controllers"), ['..', '.']);

    if ( in_array( ($controller.'_controller.php'), $controllers) )
    {
        require_once('controllers/' . $controller . '_controller.php');

        $controller = $controller.'Controller';
        $actions = get_class_methods( $controller );

        if ( in_array( $action, $actions ) )
        {
            $controller::{$action}();
        }
        else
        {
            echo'asd';exit;
            require_once('controllers/pages_controller.php');
            pagesController::error();
        }
    }
    else
    {
        var_dump($controller);exit;
        require_once('controllers/pages_controller.php');
        pagesController::error();
    }

?>
