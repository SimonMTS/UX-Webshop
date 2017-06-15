<?php

    class Order {
        public $id;
        public $descr;
        public $amount;
        public $method;
        public $status;
        public $paidDatetime;
        public $details_consumerName;
        public $details_consumerAccount;

        public function __construct($id, $descr, $amount, $method, $status, $paidDatetime, $details_consumerName, $details_consumerAccount) {
            $this->id = $id;
            $this->descr = $descr;
            $this->amount = $amount;
            $this->method = $method;
            $this->status = $status;
            $this->paidDatetime = $paidDatetime;
            $this->details_consumerName = $details_consumerName;
            $this->details_consumerAccount = $details_consumerAccount;
        }
		
        public static function all() {
            return Sql::Get('game_order');
        }

        public static function find($id) {
            $result = Sql::Get('game_order', 'id', $id);

            if (
                isset($result[0]['id']) &&
                isset($result[0]['descr']) &&
                isset($result[0]['amount']) &&
                isset($result[0]['method']) &&
                isset($result[0]['status']) &&
                isset($result[0]['paidDatetime']) &&
                isset($result[0]['details_consumerName']) &&
                isset($result[0]['details_consumerAccount'])
            ) {
                return new Order(
                    $result[0]['id'],
                    $result[0]['descr'],
                    $result[0]['amount'],
                    $result[0]['method'],
                    $result[0]['status'],
                    $result[0]['paidDatetime'],
                    $result[0]['details_consumerName'],
                    $result[0]['details_consumerAccount']
                );
            } else {
                return false;
            }
        }

        public static function findByUser($id) {
            $result = Sql::Get('game_order', 'user_id', $id);

            return $result;
        }

        public function save() {
            if ( !self::find($this->id) ) {
                
                Sql::Save('game_order', [
                    'id' => $this->id,
                    'user_id' => $_SESSION['user']['id'],
                    'descr' => $this->descr,
                    'amount' => $this->amount,
                    'method' => $this->method,
                    'status' => $this->status,
                    'paidDatetime' => $this->paidDatetime,
                    'details_consumerName' => $this->details_consumerName,
                    'details_consumerAccount' => $this->details_consumerAccount
                ]);
                
                return true;
            } else {
                Sql::Update('game_order', 'id', $this->id, [
                    'id' => $this->id,
                    'user_id' => $_SESSION['user']['id'],
                    'descr' => $this->descr,
                    'amount' => $this->amount,
                    'method' => $this->method,
                    'status' => $this->status,
                    'paidDatetime' => $this->paidDatetime,
                    'details_consumerName' => $this->details_consumerName,
                    'details_consumerAccount' => $this->details_consumerAccount
                ]);

                return true;
            }
        }
    }
?>