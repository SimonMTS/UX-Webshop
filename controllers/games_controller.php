<?php
    require_once "models/game.php";

    class gamesController extends Controller {

        public static function overview($var) {

            if (isset($_POST['var2']) && !empty($_POST['var2'])) {
                Base::Redirect($GLOBALS['config']['base_url'].'games/overview/1/'.Base::Sanitize($_POST['var2']));
            } elseif (isset($_POST['var2']) && empty($_POST['var2'])) {
                Base::Redirect($GLOBALS['config']['base_url'].'games/overview/1');
            }

            if (isset($var[2])) {
                $page = (int) Base::Sanitize( $var[2] );
                if ($page < 1) {
                    Base::Redirect( $GLOBALS['config']['base_url'].'games/overview/1' );
                }
            } else {
                $page = 1;
            }

            if (isset($var[3])) {
                $search = base::Sanitize($var[3]);
                $games = Game::searchByName($search, 12, (($page - 1) * 12) );
            } else {
                $games = Game::searchByName('', 12, (($page - 1) * 12) );
            }

            if (isset($var[3])) {
                $searchpar = '/'.$var[3];
            } else {
                $searchpar = null;
            }

            Base::Render('games/overview', [
                'games' => $games,
                'page' => $page,
                'searchpar' => $searchpar
            ]);
        }

        public static function view($var) {
            $id = Base::Sanitize( $var[2] );
            $game = Game::Find($id);
            
            if ( $game ) {
                if (isset($_SESSION['user']['id'])) {
                    $user_id = $_SESSION['user']['id'];
                } else {
                    $user_id = 'unknown';
                }

                $views = Game::addView($id, $user_id);

                if ( isset($_POST['game']) && isset($_POST['game']['rating']) && isset($_SESSION['user']) ) {
                    $rat = (int) Base::Sanitize($_POST['game']['rating']);
                    if ($rat <= 5 && $rat >= 1) {
                        Game::addRating( $id, $rat );
                        Base::Redirect( Base::Curl() );
                    }
                }

                Base::Render('games/view', [
                    'game' => $game,
                    'views' => $views,
                    'rating' => $game->rating
                ]);
            } else {
                Base::Render('pages/error', [
                    'type' => 'custom',
                    'data' => [
                        0 => 'Error',
                        1 => 'Game not found'
                    ]
                ]);
            }
        }

        public static function create() {
            if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 777) {
                if (
                    isset($_POST['game']) &&
                    isset($_POST['game']['name']) && !empty($_POST['game']['name']) &&
                    isset($_POST['game']['price']) && !empty($_POST['game']['price']) &&
                    isset($_POST['game']['descr']) && !empty($_POST['game']['descr']) &&
                    (isset($_FILES['cover']) && $_FILES['cover']['size'] > 0)
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
                        Base::Render('pages/error', [
                    'type' => 'custom',
                    'data' => [
                        0 => 'Error',
                        1 => 'Could not save game'
                    ]
                ]);
                    }
                } else {
                    Base::Render('games/create');
                }
            } else {
                Base::Render('pages/error', [
                    'type' => 'custom',
                    'data' => [
                        0 => 'Denied',
                        1 => 'This page requires admin privileges'
                    ]
                ]);
            }
        }

        public static function edit($var) {
            if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 777) {
                $id = Base::Sanitize( $var[2] );
                $game = Game::find($id);

                if (
                    isset($_POST['game']) &&
                    isset($_POST['game']['name']) &&
                    isset($_POST['game']['price']) &&
                    isset($_POST['game']['descr'])
                ) {
                    $game->name = Base::Sanitize( $_POST['game']['name'] );
                    $game->price = (int) Base::Sanitize( $_POST['game']['price'] );
                    $game->descr = Base::Sanitize( $_POST['game']['descr'] );
                    
                    if (isset($_FILES['cover']) && $_FILES['cover']['size'] > 0) {
                        $game->cover = Base::Upload_file( $_FILES['cover'] );
                    }
                    
                    if ($game->save()) {
                        Base::Redirect($GLOBALS['config']['base_url'] . "games/view/" . $game->id);
                    } else {
                        Base::Render('pages/error', [
                            'type' => 'custom',
                            'data' => [
                                0 => 'Error',
                                1 => 'Could not save game'
                            ]
                        ]);
                    }
                } else {
                    Base::Render('games/edit', [
                        'game' => $game
                    ]);
                }
            } else {
                Base::Render('pages/error', [
                    'type' => 'custom',
                    'data' => [
                        0 => 'Denied',
                        1 => 'This page requires admin privileges'
                    ]
                ]);
            }
        }

        public static function delete($var) {
            if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 777) {
                $id = Base::Sanitize( $var[2] );
                $game = Game::find($id);

                if ( $game ) { 
                    $game->delete();
                    Base::Redirect($GLOBALS['config']['base_url'] . 'games/overview');
                } else {
                    Base::Render('pages/error', [
                    'type' => 'custom',
                    'data' => [
                        0 => 'Error',
                        1 => 'Game not found'
                    ]
                ]);
                }
            } else {
                Base::Render('pages/error', [
                    'type' => 'custom',
                    'data' => [
                        0 => 'Denied',
                        1 => 'This page requires admin privileges'
                    ]
                ]);
            }
        }
    }