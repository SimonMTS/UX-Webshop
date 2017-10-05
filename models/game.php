<?php

    class Game extends model {
        public $id;
        public $name;
        public $price;
        public $descr;
        public $cover;
        public $views;
        public $rating;
        public $votes;

        public function rules()
        {
            return [
                [ ['name', 'price', 'descr', 'cover'], 'required' ],

                [ ['name'], 'unique' ],
                
                [ ['name', 'descr'], 'string' ],

                [ ['price'], 'integer' ],

                [ ['cover'], 'image', 400 ],
            ];
        }

        public function attributes()
        {
            return [
                'name' => 'Naam van de game',
                'price' => 'Prijs',
                'descr' => 'beschrijfing',
                'cover' => 'Cover afbeelding'
            ];
        }
		
		public static function searchByName($text, $limit, $offset) {
			return Sql::Search('game', 'name', $text, $limit, $offset);
		}

        public static function all() {
            return Sql::Get('game');
        }

        public static function find($id) {
            $result = Sql::Get('game', 'id', $id);

            if ( isset($result[0]) ) {
                $user = new Game();
                $user->load( $result[0] );
                return $user;
            } else {
                return false;
            }

        }

        public static function findPopular($limit) {
            return Sql::GetSorted('game', 'views', $limit);
        }

        public static function findByName($name) {
            $result = Sql::Get('game', 'name', $name);

            if ( isset($result[0]) ) {
                $user = new Game();
                $user->load( $result[0] );
                return $user;
            } else {
                return false;
            }
        }

        public static function addView( $id, $user_id ) {
            $game = self::find($id);
            if ( $game ) {
                Sql::Update('game', 'id', $id, [
                    'views' => ($game->views + 1)
                ]);

                Sql::Save('game_view', [
                    'game_id' => $game->id,
                    'user_id' => $user_id,
                    'time' => date("Y-m-d H:i:s")
                ]);

                return ($game->views + 1);
            } else {
                return false;
            }
        }

        public static function getViews($id) {
            return Sql::Get('game_view', 'game_id', $id);
        }

        public static function addRating( $id, $rating ) {
            $game = self::find($id);
            if ( $game ) {
                Sql::Update('game', 'id', $id, [
                    'votes' => ($game->votes + 1),
                    'rating' => ((($game->rating * $game->votes) + $rating) / ($game->votes + 1))
                ]);

                return ($game->votes);
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
                    'views' => $this->views,
                    'rating' => $this->rating,
                    'votes' => $this->votes
                ]);

                return true;
            } else {
                Sql::Update('game', 'id', $this->id, [
                    'id' => $this->id,
                    'name' => $this->name,
                    'price' => $this->price,
                    'descr' => $this->descr,
                    'cover' => $this->cover,
                    'views' => $this->views,
                    'rating' => $this->rating,
                    'votes' => $this->votes
                ]);

                return true;
            }
        }

        public function delete() {
            $game = self::find($this->id);

            if ($game->cover != 'assets/img/noPicture.png') {
                if ( !unlink($game->cover) ) {
                    return false;
                }
            }

            Sql::Delete('game', 'id', $this->id);
        }
    }