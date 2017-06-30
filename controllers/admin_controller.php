<?php
    require_once "models/game.php";

    class adminController {
        public static function info($var) {
            $id = Base::Sanitize( $var[2] );
            $game = Game::Find($id);
            $views = Game::getViews($id);

            

            $views = [
                mt_rand(0, 120),
                mt_rand(0, 120),
                mt_rand(0, 120),
                mt_rand(0, 120),
                mt_rand(0, 120),
                mt_rand(0, 120),
                mt_rand(0, 120),
                mt_rand(0, 120),
                mt_rand(0, 120),
                mt_rand(0, 120),
                mt_rand(0, 120),
                mt_rand(0, 120),
                mt_rand(0, 120),
                mt_rand(0, 120)
            ];

            Base::Render('admin/info', [
                'views' => $views
            ]);
        }
    }