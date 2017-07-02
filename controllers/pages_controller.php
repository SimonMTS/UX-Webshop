<?php
    require_once "models/game.php";

    class pagesController extends Controller {

        public static function home() {
            $games = Game::findPopular(4);

            self::$title = 'Home';

            Base::Render('pages/home', [
                'games' => $games
            ]);
        }

        public static function error($type = null, $data = null) {
            Base::error_view($type, $data);
        }
    }