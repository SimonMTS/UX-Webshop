<?php
    require_once "models/order.php";

    class ordersController {
        public static function view($var) {
            $id = Base::Sanitize( $var[2] );
            $order = Order::Find($id);

            Base::Render('orders/view', [
                'order' => $order
            ]);
        }
    }
?>
