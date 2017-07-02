<?php
    require_once "base/Mollie/API/Autoloader.php";
    require_once "models/game.php";
    require_once "models/order.php";

    class paymentController extends Controller {

        public static function setup($var) {
            if (!isset($_SESSION['user']['role'])) {
                Base::Redirect($GLOBALS['config']['base_url'] . 'users/create');
            }

            $id = Base::Sanitize( $var[2] );
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
            $_SESSION['game_id'] = $game->id;

            $payment = $mollie->payments->get($init_payment->id);
            
            Base::Redirect($payment->getPaymentUrl());
        }

        public static function confirm() {
            $mollie = new Mollie_API_Client;
            $mollie->setApiKey("test_CwJ8nvTDC9gzxkTAbf7HQN8veTCCUf");
            $init_payment_id = $_SESSION['payment_id'];

            $payment = $mollie->payments->get($init_payment_id);

            if ($payment->isPaid()) {
                if (isset( $payment->details->consumerName )) {
                    $details_consumerName = $payment->details->consumerName;
                } else {
                    $details_consumerName = 'unknown';
                }

                if (isset( $payment->details->consumerAccount )) {
                    $details_consumerAccount = $payment->details->consumerAccount;
                } else {
                    $details_consumerAccount = 'unknown';
                }

                $order = new Order(
                    str_replace('tr_', '', $init_payment_id ),
                    $payment->description,
                    $_SESSION['game_id'],
                    (int) $payment->amount,
                    $payment->method,
                    $payment->status,
                    $payment->paidDatetime,
                    $details_consumerName,
                    $details_consumerAccount,
                    $_SESSION['user']['id']
                );

                //stuur game//
                
                if ( $order->Save() ) {
                    Base::Render('payment/confirm', [
                        'method' => $payment->method,
                        'status' => $payment->status,
                        'paidDatetime' => $payment->paidDatetime,
                        'details_consumerName' => $details_consumerName,
                        'details_consumerAccount' => $details_consumerAccount
                    ]);
                } else {
                    Base::Render('pages/error', [
                    'type' => 'custom',
                    'data' => [
                        0 => 'Error',
                        1 => 'Could not save order'
                    ]
                ]);
                }
            } else {
                Base::Render('pages/error', [
                    'type' => 'custom',
                    'data' => [
                        0 => 'Error',
                        1 => 'Payment failed'
                    ]
                ]);
            }
        }
    }