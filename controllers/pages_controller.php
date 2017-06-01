<?php
    require_once('./models/game.php');

    class pagesController {

        public static function home() {
            $games = Game::findPopular(4);

            Base::Render('pages/home', [
                'page_title' => 'Home',
                'games' => $games
            ]);
        }

        public static function error() {
            Base::Render('pages/error');
        }
    }
?>
