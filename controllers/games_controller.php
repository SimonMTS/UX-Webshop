<?php
    require_once('./models/game.php');

    class gamesController {

        public function overview() {
            $games = Game::all();

            Base::Render('games/overview', [
                'games' => $games
            ]);
        }

        public function view() {
            Base::Render('games/view');
        }

        public function create() {
            if (
                isset($_POST['game']) &&
                isset($_POST['game']['name']) && !empty($_POST['game']['name']) &&
                isset($_POST['game']['price']) && !empty($_POST['game']['price']) &&
                isset($_POST['game']['descr']) && !empty($_POST['game']['descr']) &&
                isset($_FILES['cover']) && !empty($_FILES['cover'])
            ) {
                $game = new Game(
                    Base::Genetate_id(),
                    Base::Sanitize( $_POST['game']['name'] ),
                    (int) Base::Sanitize( $_POST['game']['price'] ),
                    Base::Sanitize( $_POST['game']['descr'] ),
                    Base::Upload_file( $_FILES['cover'] )
                );

                if ($game->save()) {
                    Base::Redirect($GLOBALS['config']['base_url'].'games/overview');
                } else {
                    Base::Render('pages/error');
                }
            } else {
                Base::Render('games/create');
            }

            Base::Render('games/create');
        }

        public function edit() {

            Base::Render('games/edit');
        }

        public function delete() {
            $id = Base::Sanitize( $_GET['var1'] );
            $game = Game::find($id);

            if ( $game ) {
                $game->delete();
                Base::Redirect($GLOBALS['config']['base_url'] . 'games/overview');
            } else {
                Base::Render('pages/error');
            }
        }
    }
?>
