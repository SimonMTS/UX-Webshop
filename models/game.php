<?php

    class Game {
        public $id;
        public $name;
        public $price;
        public $descr;
        public $cover;

        public function __construct($id, $name, $price, $descr, $cover, $views) {
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
            $this->descr = $descr;
            $this->cover = $cover;
            $this->views = $views;
        }
		
		public static function searchByName($text, $limit, $offset) {
			return Sql::Search('game', 'name', $text, $limit, $offset);
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
                isset($result[0]['cover']) &&
                isset($result[0]['views'])
            ) {
                return new Game(
                    $result[0]['id'],
                    $result[0]['name'],
                    $result[0]['price'],
                    $result[0]['descr'],
                    $result[0]['cover'],
                    $result[0]['views']
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
                isset($result[0]['cover']) &&
                isset($result[0]['views'])
            ) {
                return new User(
                    $result[0]['id'],
                    $result[0]['name'],
                    $result[0]['price'],
                    $result[0]['descr'],
                    $result[0]['cover'],
                    $result[0]['views']
                );
            } else {
                return $result;
            }
        }

        public function addView( $id ) {
            $game = self::find($id);
            if ( $game ) {
                Sql::Update('game', 'id', $id, [
                    'views' => ($game->views + 1)
                ]);

                return ($game->views + 1);
            } else {
                return false;
            }
        }

        public function save() {
            if ( !self::find($this->id) ) {
                Sql::Save('game', [
                    'id' => $this->id,
                    'name' => $this->name,
                    'price' => $this->price,
                    'descr' => $this->descr,
                    'cover' => $this->cover,
                    'views' => $this->views
                ]);

                return true;
            } else {
                Sql::Update('game', 'id', $this->id, [
                    'id' => $this->id,
                    'name' => $this->name,
                    'price' => $this->price,
                    'descr' => $this->descr,
                    'cover' => $this->cover,
                    'views' => $this->views
                ]);

                return true;
            }
        }

        public function delete() {
            $game = self::find($this->id);

            if ($game->cover != 'assets/noPicture.png') {
                if ( !unlink($game->cover) ) {
                    return false;
                }
            }

            Sql::Delete('game', 'id', $this->id);
        }
    }
?>
