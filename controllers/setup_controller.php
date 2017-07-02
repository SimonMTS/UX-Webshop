<?php
    require_once "models/user.php";
    require_once "models/game.php";
    require_once "models/order.php";

    class setupController extends Controller {

        public static function beforeAction() {
            self::$layout = 'empty';
        }

        public static function init($var) {
            $pw = 'pw';
            $start_time = new DateTime();

            if ( !(isset($var[2]) && $var[2] == $pw) && !(isset($var[2]) && $var[2] == $pw.'confirmed') ) {
                echo'error: wrong password<br><br>';exit;
            }

            if ($var[2] == $pw) {
                echo 'Are you sure you want to create/reset the database? <br><br> als dit niet werkt moet de max_execution_time omhoog in php.ini <br><br> <a href="'.$GLOBALS['config']['base_url'].'setup/init/'.$pw.'confirmed">Yes</a>';
                exit;
            }

            self::setupdb();
            self::addusers();
            self::addgames();
            self::addorders();
            self::addviews();

            echo 'Admin login is:<br> -Name: beheerder<br> -Password: beheerder<br><br>';
            $end_time = new DateTime();
            echo 'operation took ' . $start_time->diff($end_time)->i . 'min ' . $start_time->diff($end_time)->s . ' sec. <br><br>';

            echo '<a href="' . $GLOBALS['config']['base_url'] . '">home</a>';
        }

        private static function setupdb() {
            Sql::RemoveDB('striekwold_uxxx');

            Sql::CreateDB('striekwold_uxxx');
            
            Sql::CreateTable('game', [
                'id' => 'varchar(256)',
                'name' => 'varchar(256)',
                'price' => 'int(10)',
                'descr' => 'longtext',
                'cover' => 'varchar(256)',
                'views' => 'int(20)',
                'rating' => 'float',
                'votes' => 'int(20)'
            ]);
            Sql::AddPKey('game', 'id');

            Sql::CreateTable('game_view', [
                'game_id' => 'varchar(256)',
                'user_id' => 'varchar(256)',
                'time' => 'varchar(256)'
            ]);
            // Sql::AddPKey('game_view', 'game_id');
            
            Sql::CreateTable('game_order', [
                'id' => 'varchar(256)',
                'user_id' => 'varchar(256)',
                'game_name' => 'varchar(256)',
                'game_id' => 'varchar(256)',
                'amount' => 'int(10)',
                'method' => 'varchar(256)',
                'status' => 'varchar(256)',
                'paidDatetime' => 'varchar(256)',
                'details_consumerName' => 'varchar(256)',
                'details_consumerAccount' => 'varchar(256)'
            ]);
            Sql::AddPKey('game_order', 'id');

            Sql::CreateTable('user', [
                'id' => 'varchar(256)',
                'name' => 'varchar(256)',
                'password' => 'varchar(256)',
                'salt' => 'varchar(256)',
                'role' => 'int(6)',
                'pic' => 'varchar(256)',
                'voornaam' => 'varchar(256)',
                'achternaam' => 'varchar(256)',
                'geslacht' => 'varchar(3)',
                'geboorte_datum' => 'varchar(256)',
                'adres' => 'varchar(256)',
                'rated' => 'varchar(512)'
            ]);
            Sql::AddPKey('user', 'id');

            echo'done creating database<br><br>';
        }

        private static function addusers() {
            
            $salt = Base::Genetate_id();
            $users[] = new User(
                Base::Genetate_id(),
                'beheerder',
                Base::Hash_String('beheerder', $salt),
                $salt,
                777,
                'assets/default-img/harambae.jpg',
                'Simon',
                'Striekwold',
                'm',
                '19/3/1999',
                'Teugenaarsstraat, 86, 5348JE, Oss, Nederland'
            );
            
            for ($i=1; $i < 20; $i++) {
                $salt = Base::Genetate_id();

                $users[] = new User(
                    Base::Genetate_id(),
                    'test'.$i,
                    Base::Hash_String('test'.$i, $salt),
                    $salt,
                    1,
                    'assets/user.png',
                    'voornaam'.$i,
                    'achternaam'.$i,
                    'm',
                    '27/6/1993',
                    'spoorlaan, 12, 9283LK, Oss, Nederland'
                );
            }

            foreach ($users as $user) {
                if ( !$user->save() ) {
                    echo'error<br><br>';
                }
            }

            echo'done adding users<br><br>';
        }

        private static function addorders() {
            $game = Game::findByName('Red Dead Redemtion 2');
            $user = User::findByName('beheerder');

            for ($i = 1; $i < 14; $i++ ) {
                $orders[] = new order (
                    Base::Genetate_id(),
                    $game->name,
                    $game->id,
                    $game->price,
                    'ideal',
                    'paid',
                    '2017-06-30T14:37:14.0Z',
                    'T. TEST',
                    'NL17RABO0213698412',
                    $user->id
                );
            }

            foreach ($orders as $order) {
                if ( !$order->save() ) {
                    echo'error<br><br>';
                }
            }
        }

        private static function addviews() {
            $games = Game::all();
            if ($_SESSION['user']['id']) {
                $user_id = $_SESSION['user']['id'];
            } else {
                $user_id = 'unknown';
            }

            foreach ($games as $game) {
                for ($iter=0;$iter<7;$iter++) {
                    $count = mt_rand(0, 20);
                    // echo 'game: '.$game['name'].', views: '.$count.', days: '.$iter.'. <br>';
                    for ($i = 1; $i < $count; $i++ ) {
                        Sql::Save('game_view', [
                            'game_id' => $game['id'],
                            'user_id' => $user_id,
                            'time' => date("Y-m-d H:i:s", strtotime("-$iter days"))
                        ]);
                    }
                }
            }
        }

        private static function addgames() {

            $games = [
                [
                    'name' => 'For Honor',
                    'price' => 60,
                    'descr' => 'For Honor is een actievechtspel ontwikkeld door Ubisoft Montreal en uitgegeven door Ubisoft voor Windows, PlayStation 4 en Xbox One. De speler speelt alleen of samen met andere spelers bijvoorbeeld 4 vs 4.',
                    'cover' => 'assets/default-img/forhonor.jpg',
                    'views' => 0,
                    'rating' => 0,
                    'votes' => 0
                ],
				[
                    'name' => 'Red Dead Redemtion 2',
                    'price' => 60,
                    'descr' => "Red Dead Redemption 2 is een action-adventurespel in ontwikkeling bij verschillende Rockstar studio's. Het spel wordt uitgegeven door Rockstar Games en zal in de lente van 2018 uitkomen voor PlayStation 4 en Xbox One.or Honor is een actievechtspel ontwikkeld door Ubisoft Montreal en uitgegeven door Ubisoft voor Windows, PlayStation 4 en Xbox One. De speler speelt alleen of samen met andere spelers bijvoorbeeld 4 vs 4.",
                    'cover' => 'assets/default-img/rdr2.jpg',
                    'views' => 0,
                    'rating' => 0,
                    'votes' => 0
                ],
				[
                    'name' => 'Resident Evil 7',
                    'price' => 60,
                    'descr' => "Resident Evil 7: Biohazard is een survival horror-spel ontwikkeld en uitgegeven door Capcom. Het spel werd in januari 2017 wereldwijd uitgebracht voor Windows, PlayStation 4 en Xbox One. De PlayStation 4-versie ondersteunt PlayStation VR.",
                    'cover' => 'assets/default-img/res7.jpg',
                    'views' => 0,
                    'rating' => 0,
                    'votes' => 0
                ],
				[
                    'name' => 'Middle-earth: Shadow of War',
                    'price' => 60,
                    'descr' => "Middle-earth: Shadow of War is een action-adventurespel in ontwikkeling bij Monolith Productions. Het spel wordt uitgegeven door WB Games en zal in Europa op 25 augustus 2017 uitkomen voor de PlayStation 4, Windows en de Xbox One.",
                    'cover' => 'assets/default-img/shadowofwar.jpg',
                    'views' => 0,
                    'rating' => 0,
                    'votes' => 0
                ],
				[
                    'name' => 'The Legend of Zelda Breath of the Wild',
                    'price' => 60,
                    'descr' => "The Legend of Zelda: Breath of the Wild is een action-adventure-computerspel dat ontwikkeld is door Nintendo met een team onder leiding van ontwerper Eiji Aonuma.",
                    'cover' => 'assets/default-img/zeldabotw.jpg',
                    'views' => 0,
                    'rating' => 0,
                    'votes' => 0
                ],
				[
                    'name' => 'Mass Effect: Andromeda',
                    'price' => 60,
                    'descr' => "Mass Effect: Andromeda is een actierollenspel ontwikkeld door BioWare en uitgebracht door Electronic Arts voor PlayStation 4, Xbox One en Windows. Het spel werd wereldwijd uitgebracht in maart 2017.",
                    'cover' => 'assets/default-img/masseffect.jpg',
                    'views' => 0,
                    'rating' => 0,
                    'votes' => 0
                ],
				[
                    'name' => "Tom Clancy's Ghost Recon Wildlands",
                    'price' => 60,
                    'descr' => "Tom Clancy's Ghost Recon Wildlands is een tactisch schietspel ontwikkeld door Ubisoft Paris. Het spel werd op 7 maart 2017 uitgebracht voor Windows, PlayStation 4 en Xbox One.",
                    'cover' => 'assets/default-img/ghostrecon.jpg',
                    'views' => 0,
                    'rating' => 0,
                    'votes' => 0
                ],
				[
                    'name' => 'Horizon Zero Dawn',
                    'price' => 60,
                    'descr' => "Horizon Zero Dawn is een actierollenspel ontwikkeld door Guerrilla Games. Het spel wordt uitgegeven door Sony Interactive Entertainment en is in Europa op 1 maart 2017 uitgekomen voor de PlayStation 4.",
                    'cover' => 'assets/default-img/horizon.jpg',
                    'views' => 0,
                    'rating' => 0,
                    'votes' => 0
                ]
            ];
            
            for ($i = 1; $i < 21; $i++ ) {
                $games[] = [
                    'name' => "Test Game $i",
                    'price' => 60,
                    'descr' => "Lorem ipsum dolor sit amet, ea viderer postulant vel, eam nominavi insolens ea, no per denique conceptam. In homero torquatos conclusionemque mea, vix ornatus nominavi appellantur eu, ea nec pertinacia interesset.",
                    'cover' => 'assets/noPicture.png',
                    'views' => 0,
                    'rating' => 0,
                    'votes' => 0
                ];
            }

            foreach ($games as $game) {
                $game = new Game(
                    Base::Genetate_id(),
                    Base::Sanitize( $game['name'] ),
                    (int) Base::Sanitize( $game['price'] ),
                    Base::Sanitize( $game['descr'] ),
                    $game['cover'],
                    (int) $game['views'],
                    (int) $game['rating'],
                    (int) $game['votes']
                );

                if ( !$game->save() ) {
                    echo'error<br><br>';exit;
                }
            }

            echo'done adding games<br><br>';
        }
    }