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

        public function __construct($_id, $name, $password, $role, $firstname, $lastname, $age, $gender, $class_code, $child_id) {
            $this->_id = $_id;
            $this->name = $name;
            $this->password = $password;
            $this->role = $role;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->age = $age;
            $this->gender = $gender;
            $this->class_code = $class_code;
            $this->child_id = $child_id;
        }

        public static function role($text) {
            switch ($text) {
                case 'parent':
                    return 1;
                    break;
                case 'student':
                    return 2;
                    break;
                case 'teacher':
                    return 3;
                    break;
                case 'admin':
                    return 777;
                    break;
                case 1:
                    return 'parent';
                    break;
                case 2:
                    return 'student';
                    break;
                case 3:
                    return 'teacher';
                    break;
                case 777:
                    return 'admin';
                    break;
                default:
                    return false;
                    break;
            }

            return false;
        }

        public static function gender($text) {
            switch ($text) {
                case 'male':
                    return 'm';
                    break;
                case 'female':
                    return 'f';
                    break;
                case 'm':
                    return 'male';
                    break;
                case 'f':
                    return 'female';
                    break;
                default:
                    return false;
                    break;
            }

            return false;
        }

        public static function all() {
            $list = [];
            $db = db::init();

            $col = $db->user;
            $result = $col->find();

            return $result;
        }

        public static function find($_id) {
            $db = db::init();

            $col = $db->user;
            $result = $col->findOne( [ '_id' => $_id ] );

            if (
                isset($result['_id']) &&
                isset($result['name']) &&
                isset($result['password']) &&
                isset($result['role']) &&
                isset($result['firstname']) &&
                isset($result['lastname']) &&
                isset($result['age']) &&
                isset($result['gender']) &&
                isset($result['class_code']) &&
                isset($result['child_id'])
            ) {
                return new User(
                    $result['_id'],
                    $result['name'],
                    $result['password'],
                    $result['role'],
                    $result['firstname'],
                    $result['lastname'],
                    $result['age'],
                    $result['gender'],
                    $result['class_code'],
                    $result['child_id']);
            } else {
                return false;
            }

        }

        public static function findByName($name) {
            $db = db::init();

            $col = $db->user;
            $result = $col->findOne( [ 'name' => $name ] );

            if (
                isset($result['_id']) &&
                isset($result['name']) &&
                isset($result['password']) &&
                isset($result['role']) &&
                isset($result['firstname']) &&
                isset($result['lastname']) &&
                isset($result['age']) &&
                isset($result['gender']) &&
                isset($result['class_code']) &&
                isset($result['child_id'])
            ) {
                return new User(
                    $result['_id'],
                    $result['name'],
                    $result['password'],
                    $result['role'],
                    $result['firstname'],
                    $result['lastname'],
                    $result['age'],
                    $result['gender'],
                    $result['class_code'],
                    $result['child_id']);
            } else {
                return false;
            }
        }

        public static function findByRole($number, $lt) {
            $db = db::init();

            $col = $db->user;

            if (!$lt) {
                $result = $col->find( ["role" => ['$lt' => $number]] );
            } else {
                $result = $col->find( ["role" => $number] );
            }

            return $result;
        }

        public function save() {
            if (self::find($this->_id) == false) {
                $db = db::init();

                $col = $db->user;

                $doc = [
                    "_id" => $this->_id,
                    "name" => $this->name,
                    "password" => $this->password,
                    "role" => $this->role,
                    "firstname" => $this->firstname,
                    "lastname" => $this->lastname,
                    "age" => $this->age,
                    "gender" => $this->gender,
                    "class_code" => $this->class_code,
                    "child_id" => $this->child_id
                ];

                $result = $col->insert($doc);

                if ($this->_id == $_SESSION['user']['_id']) {
                    $_SESSION['user'] = $doc;
                }

                return true;
            } else {
                $db = db::init();

                $col = $db->user;

                $doc = [
                    "_id" => $this->_id,
                    "name" => $this->name,
                    "password" => $this->password,
                    "role" => $this->role,
                    "firstname" => $this->firstname,
                    "lastname" => $this->lastname,
                    "age" => $this->age,
                    "gender" => $this->gender,
                    "class_code" => $this->class_code,
                    "child_id" => $this->child_id
                ];

                $result = $col->update(
                    ["_id" => $this->_id],
                    [
                        '$set' => $doc
                    ]
                );

                if ($this->_id == $_SESSION['user']['_id']) {
                    $_SESSION['user'] = $doc;
                }

                return true;
            }
        }

        public function delete() {
            $db = db::init();

            $col = $db->user;

            $result = $col->remove(["_id" => $this->_id]);
        }
    }
?>
