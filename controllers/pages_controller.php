<?php
    require_once "models/game.php";

    class pagesController {

        public static function home() {

            $games = Game::findPopular(4);

            Base::Render('pages/home', [
                'page_title' => 'Home',
                'games' => $games
            ]);
        }

        public static function error($type = null, $data = null) {
            if (isset($type[3])) {
                $data = $type[3];
            }

            if (isset($type[2]) && $type[2] == 'fatal') {
                $type = 'fatal';
            }

            Base::Render('pages/error', [
                'type' => $type,
                'data' => $data
            ]);
        }
    }