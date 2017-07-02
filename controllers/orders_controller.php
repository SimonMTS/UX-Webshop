<?php
    require_once "models/order.php";

    class ordersController extends Controller {

        public static function view($var) {
            $id = Base::Sanitize( $var[2] );
            $order = Order::Find($id);

            if (isset($order->method)) {
                Base::Render('orders/view', [
                    'order' => $order
                ]);
            } else {
                Base::Render('pages/error', [
                    'type' => 'custom',
                    'data' => [
                        0 => 'Error',
                        1 => 'Order not found'
                    ]
                ]);
            }
        }

        public static function overview($var) {
            if (isset($var[2]) ) {
                $search = Base::Sanitize( $var[2] ); 
                $orders = Order::searchByUser($search, 5, 0);
            } else {
                $orders = Order::searchByUser('', 5, 0);
            }
            Base::Render('orders/overview', [
                'orders' => $orders
            ]);
        }
    }