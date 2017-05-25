<?php
    require_once('./models/game.php');

    class gamesController {

        public function overview() {
            if (isset($_GET['var1'] )) {
                $page = (int) Base::Sanitize( $_GET['var1'] );
                if ($page < 1) {
                    Base::Redirect($GLOBALS['config']['base_url'].'games/overview/1');
                }
            } else {
                $page = 1;
            }

            if (isset($_POST['search'])) {
                $search = base::Sanitize($_POST['search']);
                $games = Game::searchByName($search, 11, (($page - 1) * 11) );
            } else {
                $games = Game::searchByName('', 11, (($page - 1) * 11) );
            }

            Base::Render('games/overview', [
                'games' => $games,
                'page' => $page
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
                [
                    'name' => 'For Honor',
                    'price' => 60,
                    'descr' => 'For Honor is een actievechtspel ontwikkeld door Ubisoft Montreal en uitgegeven door Ubisoft voor Windows, PlayStation 4 en Xbox One. De speler speelt alleen of samen met andere spelers bijvoorbeeld 4 vs 4.',
                    'cover' => 'assets/forhonor.jpg'
                ],
				[
                    'name' => 'Red Dead Redemtion 2',
                    'price' => 60,
                    'descr' => "Red Dead Redemption 2 is een action-adventurespel in ontwikkeling bij verschillende Rockstar studio's. Het spel wordt uitgegeven door Rockstar Games en zal in de lente van 2018 uitkomen voor PlayStation 4 en Xbox One.or Honor is een actievechtspel ontwikkeld door Ubisoft Montreal en uitgegeven door Ubisoft voor Windows, PlayStation 4 en Xbox One. De speler speelt alleen of samen met andere spelers bijvoorbeeld 4 vs 4.",
                    'cover' => 'assets/rdr2.jpg'
                ],
				[
                    'name' => 'Resident Evil 7',
                    'price' => 60,
                    'descr' => "Resident Evil 7: Biohazard is een survival horror-spel ontwikkeld en uitgegeven door Capcom. Het spel werd in januari 2017 wereldwijd uitgebracht voor Windows, PlayStation 4 en Xbox One. De PlayStation 4-versie ondersteunt PlayStation VR.",
                    'cover' => 'assets/res7.jpg'
                ],
				[
                    'name' => 'Middle-earth: Shadow of War',
                    'price' => 60,
                    'descr' => "Middle-earth: Shadow of War is een action-adventurespel in ontwikkeling bij Monolith Productions. Het spel wordt uitgegeven door WB Games en zal in Europa op 25 augustus 2017 uitkomen voor de PlayStation 4, Windows en de Xbox One.",
                    'cover' => 'assets/shadowofwar.jpg'
                ],
				[
                    'name' => 'The Legend of Zelda Breath of the Wild',
                    'price' => 60,
                    'descr' => "The Legend of Zelda: Breath of the Wild is een action-adventure-computerspel dat ontwikkeld is door Nintendo met een team onder leiding van ontwerper Eiji Aonuma.",
                    'cover' => 'assets/zeldabotw.jpg'
                ],
				[
                    'name' => 'Mass Effect: Andromeda',
                    'price' => 60,
                    'descr' => "Mass Effect: Andromeda is een actierollenspel ontwikkeld door BioWare en uitgebracht door Electronic Arts voor PlayStation 4, Xbox One en Windows. Het spel werd wereldwijd uitgebracht in maart 2017.",
                    'cover' => 'assets/masseffect.jpg'
                ],
				[
                    'name' => "Tom Clancy's Ghost Recon Wildlands",
                    'price' => 60,
                    'descr' => "Tom Clancy's Ghost Recon Wildlands is een tactisch schietspel ontwikkeld door Ubisoft Paris. Het spel werd op 7 maart 2017 uitgebracht voor Windows, PlayStation 4 en Xbox One.",
                    'cover' => 'assets/ghostrecon.jpg'
                ],
				[
                    'name' => 'Horizon Zero Dawn',
                    'price' => 60,
                    'descr' => "Horizon Zero Dawn is een actierollenspel ontwikkeld door Guerrilla Games. Het spel wordt uitgegeven door Sony Interactive Entertainment en is in Europa op 1 maart 2017 uitgekomen voor de PlayStation 4.",
                    'cover' => 'assets/horizon.jpg'
                ]
            ];
            
            for ($i = 1; $i < 21; $i++ ) {
                $games[] = [
                    'name' => "Test Game $i",
                    'price' => 60,
                    'descr' => "Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.",
                    'cover' => 'assets/noPicture.png'
                ];
            }

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
