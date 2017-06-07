<?php
    require "Mollie/API/Autoloader.php";
    require "models/game.php";
    require "models/order.php";

    class paymentController {

        public static function setup() {
            $id = Base::Sanitize( $_GET['var1'] );
            $game = Game::Find($id);

            $mollie = new Mollie_API_Client;
            $mollie->setApiKey("test_CwJ8nvTDC9gzxkTAbf7HQN8veTCCUf");

            $init_payment = $mollie->payments->create([
                "amount"      => $game->price,
                "description" => $game->name,
                "redirectUrl" => $GLOBALS['config']['base_url'] . 'payment/confirm',
                "webhookUrl"  => "https://webshop.example.org/mollie-webhook/",
            ]);

            $_SESSION['payment_id'] = $init_payment->id;

            $payment = $mollie->payments->get($init_payment->id);
            
            Base::Redirect($payment->getPaymentUrl());
        }

        public static function confirm() {
            $mollie = new Mollie_API_Client;
            $mollie->setApiKey("test_CwJ8nvTDC9gzxkTAbf7HQN8veTCCUf");
            $init_payment_id = $_SESSION['payment_id'];

            $payment = $mollie->payments->get($init_payment_id);

            if ($payment->isPaid()) {
                $order = new Order(
                    str_replace('tr_', '', $init_payment_id ),
                    $payment->description,
                    (int) $payment->amount,
                    $payment->method,
                    $payment->status,
                    $payment->paidDatetime,
                    $payment->details->consumerName,
                    $payment->details->consumerAccount
                );
                
                if ( $order->Save() ) {
                    Base::Render('payment/confirm', [
                        'method' => $payment->method,
                        'status' => $payment->status,
                        'paidDatetime' => $payment->paidDatetime,
                        'details' => $payment->details
                    ]);
                } else {
                    Base::Render('pages/error');
                }
            } else {
                Base::Render('pages/error');
            }
        }
    }
?>
