<?php
    require_once "models/order.php";

    class ordersController {
        public static function view() {
            $id = Base::Sanitize( $var[3] );
            $order = Order::Find($id);

            Base::Render('orders/view', [
                'order' => $order
            ]);
        }
    }
?>
