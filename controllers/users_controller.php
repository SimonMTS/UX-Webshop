<?php
    require_once('/models/user.php');

    class usersController {

        public function login() {
            if (isset($_POST['user'])) {
                $user = User::findByName($_POST['user']['name']);
                if ( $user !== false && $user->password === Base::Hash_String($_POST['user']['password']) ) {
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

        public function logout() {
            $_SESSION['user'] = null;
            Base::Redirect($GLOBALS['config']['base_url']);
        }

        public function overview() {
            if ($_SESSION['user']['role'] == 777) {
                $users = user::all();
                
                Base::Render('users/overview', [
                    'users' => $users
                ]);
            } else {
                Base::Render('pages/error');
            }
        }

        public function view() {
            Base::Render('users/view');
        }

        public function create() {
            if (
                isset($_POST['user']) &&
                isset($_POST['user']['name']) && !empty($_POST['user']['name']) &&
                isset($_POST['user']['password']) && !empty($_POST['user']['password']) &&
                $_POST['user']['password'] === $_POST['user']['passwordrep'] &&
                !user::findByName($_POST['user']['name'])
            ) {   
                $user = new User(
                    Base::Genetate_id(),
                    $_POST['user']['name'],
                    Base::Hash_String($_POST['user']['password']),
                    1
                );

                if ($user->save()) {
                    Base::Redirect($GLOBALS['config']['base_url']);
                } else {
                    Base::Render('pages/error');
                }
            } else {
                Base::Render('users/create');
            }
        }

        public function edit() {
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

        public function delete() {
            $id = Base::Sanitize( $_GET['var1'] );
            $user = User::find($id);

            if ($_SESSION['user']['role'] > $user->role) {
                $user->delete();
                Base::Redirect($GLOBALS['config']['base_url'] . 'users/overview');
            } else {
                Base::Render('pages/error');
            }
        }
    }
?>
