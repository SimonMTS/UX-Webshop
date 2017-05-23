<?php
    require_once('./models/game.php');

    class gamesController {

        public function overview() {

            Base::Render('games/overview');
        }

        public function view() {

            Base::Render('games/view');
        }

        public function create() {
            
            Base::Render('games/create');
        }

        public function edit() {

            Base::Render('games/edit');
        }

        public function delete() {

            Base::Redirect($GLOBALS['config']['base_url'] . 'games/overview');
        }
    }
?>
