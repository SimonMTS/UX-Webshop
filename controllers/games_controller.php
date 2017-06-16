<?php
    require "models/game.php";

    class gamesController {

        public static function overview() {
            if (isset($_POST['var2']) && !empty($_POST['var2'])) {
                Base::Redirect($GLOBALS['config']['base_url'].'games/overview/1/'.Base::Sanitize($_POST['var2']));
            } elseif (isset($_POST['var2']) && empty($_POST['var2'])) {
                Base::Redirect($GLOBALS['config']['base_url'].'games/overview/1');
            }

            if (isset($_GET['var1'])) {
                $page = (int) Base::Sanitize( $_GET['var1'] );
                if ($page < 1) {
                    $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $url = str_replace('0', '1', $url);

                    Base::Redirect( $url );
                }
            } else {
                $page = 1;
            }

            if (isset($_GET['var2'])) {
                $search = base::Sanitize($_GET['var2']);
                $games = Game::searchByName($search, 11, (($page - 1) * 11) );
            } else {
                $games = Game::searchByName('', 11, (($page - 1) * 11) );
            }

            if (isset($_GET['var2'])) {
                $searchpar = '/'.$_GET['var2'];
            } else {
                $searchpar = null;
            }

            Base::Render('games/overview', [
                'games' => $games,
                'page' => $page,
                'searchpar' => $searchpar
            ]);
        }

        public static function view() {
            $id = Base::Sanitize( $_GET['var1'] );
            $game = Game::Find($id);
            
            if ( $game ) {
                $views = Game::addView($id);

                Base::Render('games/view', [
                    'game' => $game,
                    'views' => $views
                ]);
            } else {
                Base::Render('pages/error');
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
                        Base::Render('pages/error');
                    }
                } else {
                    Base::Render('games/create');
                }
            } else {
                Base::Render('pages/error');
            }
        }

        public static function edit() {
            if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 777) {
                $id = Base::Sanitize( $_GET['var1'] );
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
                        Base::Render('pages/error');
                    }
                } else {
                    Base::Render('games/edit', [
                        'game' => $game
                    ]);
                }
            } else {
                Base::Render('pages/error');
            }
        }

        public static function delete() {
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

        public static function addgames() {
            $games = [
                [
                    'name' => 'For Honor',
                    'price' => 60,
                    'descr' => 'For Honor is een actievechtspel ontwikkeld door Ubisoft Montreal en uitgegeven door Ubisoft voor Windows, PlayStation 4 en Xbox One. De speler speelt alleen of samen met andere spelers bijvoorbeeld 4 vs 4.',
                    'cover' => 'assets/img/forhonor.jpg',
                    'views' => 0
                ],
				[
                    'name' => 'Red Dead Redemtion 2',
                    'price' => 60,
                    'descr' => "Red Dead Redemption 2 is een action-adventurespel in ontwikkeling bij verschillende Rockstar studio's. Het spel wordt uitgegeven door Rockstar Games en zal in de lente van 2018 uitkomen voor PlayStation 4 en Xbox One.or Honor is een actievechtspel ontwikkeld door Ubisoft Montreal en uitgegeven door Ubisoft voor Windows, PlayStation 4 en Xbox One. De speler speelt alleen of samen met andere spelers bijvoorbeeld 4 vs 4.",
                    'cover' => 'assets/img/rdr2.jpg',
                    'views' => 0
                ],
				[
                    'name' => 'Resident Evil 7',
                    'price' => 60,
                    'descr' => "Resident Evil 7: Biohazard is een survival horror-spel ontwikkeld en uitgegeven door Capcom. Het spel werd in januari 2017 wereldwijd uitgebracht voor Windows, PlayStation 4 en Xbox One. De PlayStation 4-versie ondersteunt PlayStation VR.",
                    'cover' => 'assets/img/res7.jpg',
                    'views' => 0
                ],
				[
                    'name' => 'Middle-earth: Shadow of War',
                    'price' => 60,
                    'descr' => "Middle-earth: Shadow of War is een action-adventurespel in ontwikkeling bij Monolith Productions. Het spel wordt uitgegeven door WB Games en zal in Europa op 25 augustus 2017 uitkomen voor de PlayStation 4, Windows en de Xbox One.",
                    'cover' => 'assets/img/shadowofwar.jpg',
                    'views' => 0
                ],
				[
                    'name' => 'The Legend of Zelda Breath of the Wild',
                    'price' => 60,
                    'descr' => "The Legend of Zelda: Breath of the Wild is een action-adventure-computerspel dat ontwikkeld is door Nintendo met een team onder leiding van ontwerper Eiji Aonuma.",
                    'cover' => 'assets/img/zeldabotw.jpg',
                    'views' => 0
                ],
				[
                    'name' => 'Mass Effect: Andromeda',
                    'price' => 60,
                    'descr' => "Mass Effect: Andromeda is een actierollenspel ontwikkeld door BioWare en uitgebracht door Electronic Arts voor PlayStation 4, Xbox One en Windows. Het spel werd wereldwijd uitgebracht in maart 2017.",
                    'cover' => 'assets/img/masseffect.jpg',
                    'views' => 0
                ],
				[
                    'name' => "Tom Clancy's Ghost Recon Wildlands",
                    'price' => 60,
                    'descr' => "Tom Clancy's Ghost Recon Wildlands is een tactisch schietspel ontwikkeld door Ubisoft Paris. Het spel werd op 7 maart 2017 uitgebracht voor Windows, PlayStation 4 en Xbox One.",
                    'cover' => 'assets/img/ghostrecon.jpg',
                    'views' => 0
                ],
				[
                    'name' => 'Horizon Zero Dawn',
                    'price' => 60,
                    'descr' => "Horizon Zero Dawn is een actierollenspel ontwikkeld door Guerrilla Games. Het spel wordt uitgegeven door Sony Interactive Entertainment en is in Europa op 1 maart 2017 uitgekomen voor de PlayStation 4.",
                    'cover' => 'assets/img/horizon.jpg',
                    'views' => 0
                ]
            ];
            
            for ($i = 1; $i < 21; $i++ ) {
                $games[] = [
                    'name' => "Test Game $i",
                    'price' => 60,
                    'descr' => "Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.",
                    'cover' => 'assets/img/noPicture.png',
                    'views' => 0
                ];
            }

            foreach ($games as $game) {
                $game = new Game(
                    Base::Genetate_id(),
                    Base::Sanitize( $game['name'] ),
                    (int) Base::Sanitize( $game['price'] ),
                    Base::Sanitize( $game['descr'] ),
                    $game['cover'],
                    (int) $game['views']
                );

                if ( !$game->save() ) {
                    echo'error';exit;
                }
            }
        }
    }
?>
