<?php
    class usersController {

        public function login() {

            if (isset($_POST['user'])) {
                $user = User::findByName($_POST['user']['name']);

                if ($user !== false) {
                    if ($user->password === hash('sha512', $_POST['user']['password'])) {

                        $_SESSION['user'] = [
                            "_id" => $user->_id,
                            "name" => $user->name,
                            "password" => $user->password,
                            "role" => $user->role,
                            "firstname" => $user->firstname,
                            "lastname" => $user->lastname,
                            "age" => $user->age,
                            "gender" => $user->gender,
                            "class_code" => $user->class_code,
                            "child_id" => $user->child_id
                        ];

                        Base::Redirect($GLOBALS['config']['base_url']);
                    } else {
                        require_once('views/users/login.php');
                    }
                } else {
                    require_once('views/users/login.php');
                }
            } else {
                require_once('views/users/login.php');
            }
        }

        public function logout() {
            $_SESSION['user'] = null;
            Base::Redirect($GLOBALS['config']['base_url']);
        }

        public function overview() {
            if ($_SESSION['user']['role'] > 1) {
                $users = user::findByRole($_SESSION['user']['role'], false);

                require_once('views/users/overview.php');
            } else {
                return call('pages', 'error');
            }
        }

        public function view() {
            switch ($_SESSION['user']['role']) {
                case 1: // parent
                    $docs = doc::findByUser($_SESSION['user']['child_id']);

                    require_once('views/users/view.php');
                    break;
                case 2: // student
                    $docs = doc::findByUser($_SESSION['user']['_id']);

                    require_once('views/users/view.php');
                    break;
                case 3: // teacher
                    $docs = doc::findByClass($_SESSION['user']['class_code']);

                    require_once('views/users/view.php');
                    break;
                case 777: // admin
                    $docs = doc::all();

                    require_once('views/users/view.php');
                    break;
            }
        }

        public function create() {
            if (isset($_SESSION['user']['_id']) && $_SESSION['user']['role'] > 2) {
                $students = user::findByRole(2, true);

                if (
                    isset($_POST['user']) &&
                    isset($_POST['user']['name']) && !empty($_POST['user']['name']) &&
                    isset($_POST['user']['password']) && !empty($_POST['user']['password']) &&
                    isset($_POST['user']['role']) && !empty($_POST['user']['role']) &&
                    isset($_POST['user']['firstname']) && !empty($_POST['user']['firstname']) &&
                    isset($_POST['user']['lastname']) && !empty($_POST['user']['lastname']) &&
                    isset($_POST['user']['age']) && !empty($_POST['user']['age']) &&
                    isset($_POST['user']['gender']) && !empty($_POST['user']['gender']) &&
                    $_POST['user']['password'] == $_POST['user']['passwordrep']
                ) {
                    if (!user::findByName($_POST['user']['name']) && user::role($_POST['user']['role']) != false) {
                        if (isset($_POST['user']['class_code']) && !empty($_POST['user']['class_code'])) {
                            $class_code = $_POST['user']['class_code'];
                        } else {
                            $class_code = false;
                        }

                        if (isset($_POST['user']['child_id']) && !empty($_POST['user']['child_id'])) {
                            $child_id = $_POST['user']['child_id'];
                        } else {
                            $child_id = false;
                        }

                        $user = new User(
                            new MongoId(),
                            $_POST['user']['name'],
                            hash('sha512', $_POST['user']['password']),
                            user::role($_POST['user']['role']),
                            $_POST['user']['firstname'],
                            $_POST['user']['lastname'],
                            $_POST['user']['age'],
                            user::gender($_POST['user']['gender']),
                            $class_code,
                            $child_id
                        );

                        if ($user->save()) {
                            Base::Redirect($GLOBALS['config']['base_url']);
                        } else {
                            return call('pages', 'error');
                        }
                    } else {
                        require_once('views/users/create.php');
                    }
                } else {
                    require_once('views/users/create.php');
                }
            } else {
                return call('pages', 'error');
            }
        }

        public function edit() {
            $id = $_GET['var1'];
            $user = User::find(new MongoId($id));
            $students = user::findByRole(2, true);

            if ($user !== false && (($user->_id == $_SESSION['user']['_id'] && $user->password == $_SESSION['user']['password']) || ($_SESSION['user']['role'] > $user->role))) {
                if (
                    isset($_POST['user']) &&
                    isset($_POST['user']['name']) && !empty($_POST['user']['name']) &&
                    isset($_POST['user']['firstname']) && !empty($_POST['user']['firstname']) &&
                    isset($_POST['user']['lastname']) && !empty($_POST['user']['lastname']) &&
                    isset($_POST['user']['age']) && !empty($_POST['user']['age']) &&
                    isset($_POST['user']['gender']) && !empty($_POST['user']['gender']) &&
                    ((isset($_POST['user']['password']) && !empty($_POST['user']['password']) && $_POST['user']['password'] == $_POST['user']['passwordrep']) ||
                    (empty($_POST['user']['password']) && empty($_POST['user']['passwordrep'])))
                ) {
                    $user->name = $_POST['user']['name'];
                    $user->firstname = $_POST['user']['firstname'];
                    $user->lastname = $_POST['user']['lastname'];
                    $user->age = $_POST['user']['age'];
                    $user->gender = user::gender($_POST['user']['gender']);

                    if (isset($_POST['user']['class_code']) && !empty($_POST['user']['class_code'])) {
                        $user->class_code = $_POST['user']['class_code'];
                    }
                    if (isset($_POST['user']['child_id']) && !empty($_POST['user']['child_id'])) {
                        $user->child_id = $_POST['user']['child_id'];
                    }

                    if (!empty($_POST['user']['password'])) {
                        $user->password = $_POST['user']['password'];
                    }

                    if ($user->save()) {
                        Base::Redirect($GLOBALS['config']['base_url'] . "users/edit/" . $user->_id);
                    } else {
                        return call('pages', 'error');
                    }
                } else {
                    require_once('views/users/edit.php');
                }
            } else {
                return call('pages', 'error');
            }
        }

        public function delete() {
            $id = $_GET['var1'];
            $user = User::find(new MongoId($id));

            if ($_SESSION['user']['role'] > $user->role) {
                $user->delete();
                Base::Redirect($GLOBALS['config']['base_url'] . 'users/overview');
            } else {
                return call('pages', 'error');
            }
        }
    }
?>
