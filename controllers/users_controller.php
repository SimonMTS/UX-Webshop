<?php
    require_once('./models/user.php');

    class usersController {

        public static function login() {
            if (isset($_POST['user'])) {
                $user = User::findByName($_POST['user']['name']);
                if ( $user != false && $user->password === Base::Hash_String($_POST['user']['password']) ) {
                    $_SESSION['user'] = [
                        "id" => $user->id,
                        "name" => $user->name,
                        "password" => $user->password,
                        "role" => $user->role
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

        public static function overview() {
            if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 777) {
				if (isset($_POST['var2']) && !empty($_POST['var2'])) {
					Base::Redirect($GLOBALS['config']['base_url'].'users/overview/1/'.Base::Sanitize($_POST['var2']));
				} elseif (isset($_POST['var2']) && empty($_POST['var2'])) {
					Base::Redirect($GLOBALS['config']['base_url'].'users/overview/1');
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
					$users = User::searchByName($search, 11, (($page - 1) * 11) );
				} else {
					$users = User::searchByName('', 11, (($page - 1) * 11) );
				}
				
				if (isset($_GET['var2'])) {
					$searchpar = '/'.$_GET['var2'];
				} else {
					$searchpar = null;
				}

				Base::Render('users/overview', [
					'users' => $users,
					'page' => $page,
					'searchpar' => $searchpar
				]);
            } else {
                Base::Render('pages/error');
            }
        }

        public static function view() {
            Base::Render('users/view');
        }

        public static function create() {
            if (
                isset($_POST['user']) &&
                isset($_POST['user']['name']) && !empty($_POST['user']['name']) &&
                isset($_POST['user']['password']) && !empty($_POST['user']['password']) &&
                $_POST['user']['password'] === $_POST['user']['passwordrep'] &&
                !user::findByName($_POST['user']['name'])
            ) {
                $user = new User(
                    Base::Genetate_id(),
                    Base::Sanitize( $_POST['user']['name'] ),
                    Base::Hash_String( $_POST['user']['password'] ),
                    1
                );

                if ($user->save()) {
                    if ( !isset($_SESSION['user']) ) {
                        $_SESSION['user'] = [
                            "id" => $user->id,
                            "name" => $user->name,
                            "password" => $user->password,
                            "role" => $user->role
                        ];
                    }

                    if ($_SESSION['user']['role'] == 777) {
                        Base::Redirect($GLOBALS['config']['base_url'].'users/overview');
                    } else {
                        Base::Redirect($GLOBALS['config']['base_url']);
                    }
                } else {
                    Base::Render('pages/error');
                }
            } else {
                Base::Render('users/create');
            }
        }

        public static function edit() {
            $id = Base::Sanitize( $_GET['var1'] );
            $user = User::find($id);

            if ($user !== false && (($user->id == $_SESSION['user']['id'] && $user->password == $_SESSION['user']['password']) || ($_SESSION['user']['role'] == 777))) {
                if (
                    isset($_POST['user']) &&
                    isset($_POST['user']['name']) && !empty($_POST['user']['name']) &&
                    ((isset($_POST['user']['password']) && !empty($_POST['user']['password']) && $_POST['user']['password'] == $_POST['user']['passwordrep']) ||
                    (empty($_POST['user']['password']) && empty($_POST['user']['passwordrep'])))
                ) {
                    $user->name = Base::Sanitize( $_POST['user']['name'] );

                    if (!empty($_POST['user']['password'])) {
                        $user->password = Base::Hash_String($_POST['user']['password']);
                    }

                    if ($user->save()) {
                        Base::Redirect($GLOBALS['config']['base_url'] . "users/edit/" . $user->id);
                    } else {
                        Base::Render('pages/error');
                    }
                } else {
                    Base::Render('users/edit', [
                        'user' => $user
                    ]);
                }
            } else {
                Base::Render('pages/error');
            }
        }

        public static function delete() {
            if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 777) {
                $id = Base::Sanitize( $_GET['var1'] );
                $user = User::find($id);

                if ($_SESSION['user']['role'] > $user->role) {
                    $user->delete();
                    Base::Redirect($GLOBALS['config']['base_url'] . 'users/overview');
                } else {
                    Base::Render('pages/error');
                }
            } else {
                Base::Render('pages/error');
            }
        }
    }
?>
