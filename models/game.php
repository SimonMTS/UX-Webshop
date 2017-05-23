<?php

    class Game {
        public $id;
        public $name;
        public $price;
        public $desc;
        public $cover;

        public function __construct($id, $name) {
            $this->id = $id;
            $this->name = $name;
        }

        public static function all() {
            return Sql::Get('game');
        }

        public static function find($id) {
            $result = Sql::Get('game', 'id', $id);

            if (
                isset($result[0]['id']) &&
                isset($result[0]['name'])
            ) {
                return new User(
                    $result[0]['id'],
                    $result[0]['name']);
            } else {
                return false;
            }

        }

        public static function findByName($name) {
            $result = Sql::Get('game', 'name', $name);

            if (
                isset($result[0]['id']) &&
                isset($result[0]['name'])
            ) {
                return new User(
                    $result[0]['id'],
                    $result[0]['name']);
            } else {
                return $result;
            }
        }

        public function save() {
            if ( !self::find($this->id) ) {
                Sql::Save('game', [
                    'id' => $this->id,
                    'name' => $this->name
                ]);

                return true;
            } else {
                Sql::Update('game', 'id', $this->id, [
                    'id' => $this->id,
                    'name' => $this->name
                ]);

                return true;
            }
        }

        public function delete() {
            Sql::Delete('game', 'id', $this->id);
        }
    }
?>
