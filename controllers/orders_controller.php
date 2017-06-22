<?php
    require_once "models/order.php";

    class ordersController {
        public static function view($var) {
            $id = Base::Sanitize( $var[2] );
            $order = Order::Find($id);

            if (isset($order->method)) {
                Base::Render('orders/view', [
                    'order' => $order
                ]);
            } else {
                Base::Render('pages/error');
            }
        }
    }
?>
