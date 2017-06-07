<?php
    require "models/order.php";

    class ordersController {
        public static function view() {
            $id = Base::Sanitize( $_GET['var1'] );
            $order = Order::Find($id);

            Base::Render('orders/view', [
                'order' => $order
            ]);
        }
    }
?>
