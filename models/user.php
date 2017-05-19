<?php

    class User {
        public $_id;
        public $name;
        public $password;
        public $role;
        public $class_code;
        public $child_id;
        public $firstname;
        public $lastname;
        public $age;
        public $gender;

        public function __construct($id, $name, $password, $role) {
            $this->id = $id;
            $this->name = $name;
            $this->password = $password;
            $this->role = $role;
        }

        public static function role($text) { //eval
            switch ($text) {
                case 'User':
                    return 1;
                    break;
                case 'Admin':
                    return 777;
                    break;
                case 1:
                    return 'User';
                    break;
                case 777:
                    return 'Admin';
                    break;
                default:
                    return false;
                    break;
            }
        }

        public static function all() {
            return Sql::Get('user');
        }

        public static function find($id) {
            $result = Sql::Get('user', 'id', $id);

            if (
                isset($result[0]['id']) &&
                isset($result[0]['name']) &&
                isset($result[0]['password']) &&
                isset($result[0]['role'])
            ) {
                return new User(
                    $result[0]['id'],
                    $result[0]['name'],
                    $result[0]['password'],
                    $result[0]['role']);
            } else {
                return false;
            }

        }

        public static function findByName($name) {
            $result = Sql::Get('user', 'name', $name);

            if (
                isset($result[0]['id']) &&
                isset($result[0]['name']) &&
                isset($result[0]['password']) &&
                isset($result[0]['role'])
            ) {
                return new User(
                    $result[0]['id'],
                    $result[0]['name'],
                    $result[0]['password'],
                    $result[0]['role']);
            } else {
                return $result;
            }
        }

        public static function findByRole($number, $lt) {
            if (!$lt && false) {
                $result = $col->find( ["role" => ['$lt' => $number]] );
            } else {
                $result = Sql::Get('user', 'role', $number);
            }

            return $result;
        }

        public function save() {
            if ( !self::find($this->id) ) {
                Sql::Save('user', [
                    'id' => $this->id,
                    'name' => $this->name,
                    'password' => $this->password,
                    'role' => $this->role,
                ]);

                $_SESSION['user'] = [
                    "id" => $this->id,
                    "name" => $this->name,
                    "password" => $this->password,
                    "role" => $this->role
                ];

                return true;
            } else {
                Sql::Update('user', 'id', $this->id, [
                    'id' => $this->id,
                    'name' => $this->name,
                    'password' => $this->password,
                    'role' => $this->role,
                ]);

                $_SESSION['user'] = [
                    "id" => $this->id,
                    "name" => $this->name,
                    "password" => $this->password,
                    "role" => $this->role
                ];

                return true;
            }
        }

        public function delete() {
            Sql::Delete('user', 'id', $this->id);
        }
    }
?>
