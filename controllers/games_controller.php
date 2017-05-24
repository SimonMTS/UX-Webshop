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
            $id = Base::Sanitize( $_GET['var1'] );
            $game = Game::Find($id);

            Base::Render('games/view', [
                'game' => $game
            ]);
        }

        public function create() {
            if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 777) {
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
            } else {
                Base::Render('pages/error');
            }
        }

        public function edit() {
            if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 777) {
                
                Base::Render('games/edit');
            } else {
                Base::Render('pages/error');
            }
        }

        public function delete() {
            if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 777) {
                $id = Base::Sanitize( $_GET['var1'] );
                $game = Game::find($id);

                if ( $game ) {
                    $game->delete();
                    Base::Redirect($GLOBALS['config']['base_url'] . 'games/overview');
                } else {
                    Base::Render('pages/error');
                }
            } else {
                Base::Render('pages/error');
            }
        }

        public function addgames() {
            $games = [
                'test_game' => [
                    'name' => 'test_game',
                    'price' => 20,
                    'descr' => 'test_descr',
                    'cover' => 'assets/test_game.jpg'
                ]
            ];
            
            foreach ($games as $game) {
                $game = new Game(
                    Base::Genetate_id(),
                    Base::Sanitize( $game['name'] ),
                    (int) Base::Sanitize( $game['price'] ),
                    Base::Sanitize( $game['descr'] ),
                    $game['cover']
                );

                if ( !$game->save() ) {
                    echo'error';exit;
                }
            }
        }
    }
?>
