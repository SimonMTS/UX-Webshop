<?php
    require_once "models/user.php";
    require_once "models/order.php";

    class usersController extends Controller {
        
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
                        Base::Redirect( $GLOBALS['config']['base_url'].'users/overview/1' );
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

        public static function create($var) 
        {
            $user = new User();

            if ( $user->load('post') && $user->validate() ) {
                $user->id = Base::Genetate_id();
                $user->salt = Base::Genetate_id();
                $user->role = 1;
                $user->password = Base::Hash_String( $user->password, $user->salt );

                if ( $user->save() ) {
                    if ( !isset($_SESSION['user']) ) {
                        $user->login();
                    }

                    if ( $user->isAdmin() ) {
                        Base::Redirect($GLOBALS['config']['base_url'].'users/overview');
                    } else {
                        Base::Redirect($GLOBALS['config']['base_url']);
                    }
                } else {
                    Base::Render('pages/error', [
                        'type' => 'custom',
                        'data' => [
                            'Error',
                            'Could not save user'
                        ]
                    ]);
                }
            } else {
                Base::Render('users/create', [
					'var' => $var,
                    'user' => $user
				]);
            }
        }

        public static function edit($var) 
        { 
            $id = Base::Sanitize( $var[2] );
            $user = User::find($id);
            $model = clone($user);
            $model->password_rep = $model->password;

            if ( $model->load('post') && $model->validate() ) {

                if ( $user->password != $model->password ) {
                    $user->password = Base::Hash_String( $model->password, $user->salt );
                }

                if ( is_string($model->pic) && sizeof( explode('/', $model->pic) ) == 3 ) {
                    $user->pic = $model->pic;
                }

                $user->name = $model->name;
                $user->voornaam = $model->voornaam;
                $user->achternaam = $model->achternaam;
                $user->geslacht = $model->geslacht;
                $user->geboorte_datum = $model->geboorte_datum;
                $user->adres = $model->adres;

                if ( $user->save() ) {
                    $user->login();
                    Base::Redirect($GLOBALS['config']['base_url'].'users/view/'.$user->id);
                } else {
                    Base::Render('pages/error', [
                        'type' => 'custom',
                        'data' => [
                            'Error',
                            'Could not save user'
                        ]
                    ]);
                }
            } else {
                Base::Render('users/edit', [
                    'user' => $user,
                    'var' => $var
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