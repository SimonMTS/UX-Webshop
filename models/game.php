<?php

    class Game {
        public $id;
        public $name;
        public $price;
        public $descr;
        public $cover;

        public function __construct($id, $name, $price, $descr, $cover) {
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
            $this->descr = $descr;
            $this->cover = $cover;
        }

        public static function all() {
            return Sql::Get('game');
        }

        public static function find($id) {
            $result = Sql::Get('game', 'id', $id);

            if (
                isset($result[0]['id']) &&
                isset($result[0]['name']) &&
                isset($result[0]['price']) &&
                isset($result[0]['descr']) &&
                isset($result[0]['cover'])
            ) {
                return new Game(
                    $result[0]['id'],
                    $result[0]['name'],
                    $result[0]['price'],
                    $result[0]['descr'],
                    $result[0]['cover']
                );
            } else {
                return false;
            }

        }

        public static function findByName($name) {
            $result = Sql::Get('game', 'name', $name);

            if (
                isset($result[0]['id']) &&
                isset($result[0]['name']) &&
                isset($result[0]['price']) &&
                isset($result[0]['descr']) &&
                isset($result[0]['cover'])
            ) {
                return new User(
                    $result[0]['id'],
                    $result[0]['name'],
                    $result[0]['price'],
                    $result[0]['descr'],
                    $result[0]['cover']
                );
            } else {
                return $result;
            }
        }

        public function save() {
            if ( !self::find($this->id) ) {
                Sql::Save('game', [
                    'id' => $this->id,
                    'name' => $this->name,
                    'price' => $this->price,
                    'descr' => $this->descr,
                    'cover' => $this->cover
                ]);

                return true;
            } else {
                Sql::Update('game', 'id', $this->id, [
                    'id' => $this->id,
                    'name' => $this->name,
                    'price' => $this->price,
                    'descr' => $this->descr,
                    'cover' => $this->cover
                ]);

                return true;
            }
        }

        public function delete() {
            $game = self::find($this->id);

            if ( unlink($game->cover) ) {
                Sql::Delete('game', 'id', $this->id);
            } else {
                return false;
            }
        }
    }
?>
