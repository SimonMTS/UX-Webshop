<?php
    require_once "models/user.php";
    require_once "models/order.php";

    class usersController {

        public static function login() {
            if (isset($_POST['user'])) {
                $user = User::findByName($_POST['user']['name']);
                if ( $user != false && $user->password === Base::Hash_String($_POST['user']['password'], $user->salt) ) {
                    $_SESSION['user'] = [
                        "id" => $user->id,
                        "name" => $user->name,
                        "password" => $user->password,
                        "salt" => $user->salt,
                        "role" => $user->role,
                        "pic" => $user->pic
                    ];

                    Base::Redirect($GLOBALS['config']['base_url']);
                } else {
                    Base::Render('users/login');
                }
            } else {
                Base::Render('users/login');
            }
        }

        public static function logout() {
            $_SESSION['user'] = null;
            Base::Redirect($GLOBALS['config']['base_url']);
        }

        public static function overview($var) {
            if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 777) {

				if (isset($_POST['var2']) && !empty($_POST['var2'])) {
                    Base::Redirect($GLOBALS['config']['base_url'].'users/overview/1/'.Base::Sanitize($_POST['var2']));
                } elseif (isset($_POST['var2']) && empty($_POST['var2'])) {
                    Base::Redirect($GLOBALS['config']['base_url'].'users/overview/1');
                }

                if (isset($var[2])) {
                    $page = (int) Base::Sanitize( $var[2] );
                    if ($page < 1) {
                        $url = Base::Curl();
                        $url = str_replace('0', '1', $url);

                        Base::Redirect( $url );
                    }
                } else {
                    $page = 1;
                }

                if (isset($var[3])) {
                    $search = base::Sanitize($var[3]);
                    $users = User::searchByName($search, 8, (($page - 1) * 8) );
                } else {
                    $users = User::searchByName('', 8, (($page - 1) * 8) );
                }

                if (isset($var[3])) {
                    $searchpar = '/'.$var[3];
                } else {
                    $searchpar = null;
                }

                Base::Render('users/overview', [
                    'users' => $users,
                    'page' => $page,
                    'searchpar' => $searchpar,
                    'var' => $var
                ]);
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

        public static function view($var) {
            $id = Base::Sanitize( $var[2] );
            $user = User::Find($id);

            if ($user !== false && isset($_SESSION['user']) && (($user->id == $_SESSION['user']['id'] && $user->password == $_SESSION['user']['password']) || ($_SESSION['user']['role'] == 777))) {
                $orders = Order::FindByUser($id);
                
                Base::Render('users/view', [
                    'user' => $user,
                    'orders' => array_reverse($orders)
                ]);
            } else {
                Base::Render('pages/error', [
                    'type' => 'custom',
                    'data' => [
                        0 => 'Error',
                        1 => 'User not found'
                    ]
                ]);
            }
        }

        public static function create() {
            if (
                isset($_POST['user']) &&
                isset($_POST['user']['name']) && !empty($_POST['user']['name']) &&
                isset($_POST['user']['password']) && !empty($_POST['user']['password']) &&
                $_POST['user']['password'] === $_POST['user']['passwordrep'] &&
                !user::findByName($_POST['user']['name']) &&
                
                isset($_POST['user']['voornaam']) && !empty($_POST['user']['voornaam']) &&
                isset($_POST['user']['achternaam']) && !empty($_POST['user']['achternaam']) &&
                isset($_POST['user']['geslacht']) && !empty($_POST['user']['geslacht']) &&
                isset($_POST['user']['geboorte_datum']) && sizeof($_POST['user']['geboorte_datum']) == 3 &&
                isset($_POST['user']['adres']) && !empty($_POST['user']['adres'])
            ) {
                if ( $_FILES['pic']['size'] > 0 ) {
                    $pic = Base::Upload_file( $_FILES['pic'] );
                } else {
                    $pic = 'assets/img/user.png';
                }
                
                $salt = Base::Genetate_id();

                $user = new User(
                    Base::Genetate_id(),
                    Base::Sanitize( $_POST['user']['name'] ),
                    Base::Hash_String( $_POST['user']['password'], $salt ),
                    $salt,
                    1,
                    $pic,
                    Base::Sanitize( $_POST['user']['voornaam'] ),
                    Base::Sanitize( $_POST['user']['achternaam'] ),
                    Base::Sanitize( $_POST['user']['geslacht'] ),
                    implode( '/', $_POST['user']['geboorte_datum'] ),
                    Base::Sanitize( $_POST['user']['adres'] )
                );
                
                if ($user->save()) {
                    if ( !isset($_SESSION['user']) ) {
                        $_SESSION['user'] = [
                            "id" => $user->id,
                            "name" => $user->name,
                            "password" => $user->password,
                            "salt" => $user->salt,
                            "role" => $user->role,
                            "pic" => $user->pic
                        ];
                    }

                    if ($_SESSION['user']['role'] == 777) {
                        Base::Redirect($GLOBALS['config']['base_url'].'users/overview');
                    } else {
                        Base::Redirect($GLOBALS['config']['base_url']);
                    }
                } else {
                    Base::Render('pages/error', [
                        'type' => 'custom',
                        'data' => [
                            0 => 'Error',
                            1 => 'Could not save user'
                        ]
                    ]);
                }
            } else {
                Base::Render('users/create');
            }
        }

        public static function edit($var) {
            $id = Base::Sanitize( $var[2] );
            $user = User::find($id);

            if ($user !== false && isset($_SESSION['user']) && (($user->id == $_SESSION['user']['id'] && $user->password == $_SESSION['user']['password']) || ($_SESSION['user']['role'] == 777))) {
                if (
                    isset($_POST['user']) &&
                    isset($_POST['user']['name']) && !empty($_POST['user']['name']) &&
                    ((isset($_POST['user']['password']) && !empty($_POST['user']['password']) && $_POST['user']['password'] == $_POST['user']['passwordrep']) ||
                    (empty($_POST['user']['password']) && empty($_POST['user']['passwordrep'])))
                ) {
                    $user->name = Base::Sanitize( $_POST['user']['name'] );
                    $user->voornaam = Base::Sanitize( $_POST['user']['voornaam'] );
                    $user->achternaam = Base::Sanitize( $_POST['user']['achternaam'] );
                    $user->geslacht = Base::Sanitize( $_POST['user']['geslacht'] );
                    $user->geboorte_datum = implode( '/', $_POST['user']['geboorte_datum'] );
                    $user->adres = Base::Sanitize( $_POST['user']['adres'] );

                    if (!empty($_POST['user']['password'])) {
                        $user->password = Base::Hash_String($_POST['user']['password'], $user->salt);
                    }

                    if ($_FILES['pic']['size'] > 0) {
                        $user->pic = Base::Upload_file( $_FILES['pic'] );
                    }

                    if ($user->save()) {
                        if ( $_SESSION['user']['id'] == $user->id ) {
                            $_SESSION['user'] = [
                                "id" => $user->id,
                                "name" => $user->name,
                                "password" => $user->password,
                                "salt" => $user->salt,
                                "role" => $user->role,
                                "pic" => $user->pic
                            ];
                        }
                        Base::Redirect($GLOBALS['config']['base_url'] . "users/view/" . $user->id);
                    } else {
                        Base::Render('pages/error', [
                            'type' => 'custom',
                            'data' => [
                                0 => 'Error',
                                1 => 'Could not save user'
                            ]
                        ]);
                    }
                } else {
                    Base::Render('users/edit', [
                        'user' => $user
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
                $user = User::find($id);

                if ($_SESSION['user']['role'] > $user->role) {
                    $user->delete();
                    Base::Redirect($GLOBALS['config']['base_url'] . 'users/overview');
                } else {
                    Base::Render('pages/error', [
                       'type' => 'custom',
                        'data' => [
                            0 => 'Denied',
                            1 => 'You can only delete user of a lower role than you own'
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