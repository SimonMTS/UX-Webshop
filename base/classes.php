<?php

    class Base {

        public static function Redirect( $url ) {
            if (headers_sent()) {
                echo '<meta http-equiv="Location" content="' . $url . '">';
                echo '<script> location.replace("' . $url . '"); </script>';
                echo '<a href="' . $url . '">' . $url . '</a>';
                exit;
            } else {
                header('location: ' . $url);exit;
            }
        }

        public static function Render( $view, $Cvar = null ) {
            if ( !isset($Cvar['page_title']) ) {
                $Cvar['page_title'] = $GLOBALS['config']['Default_Title'];
            }
            
            $view = $view . '.php';

            require_once('views/layout.php');
        }

        public static function Sanitize($string) {
            return htmlentities($string);
        }

        public static function Genetate_id($string) {
            return str_replace('.', '', uniqid('', true));;
        }

        public static function Hash_String($string) {
            return hash('sha512', $string);
        }
    }

    class Sql {
        private static $instance = NULL;

        private static function getInstance() {
            if (!isset(self::$instance)) {
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                self::$instance = new PDO('mysql:host=localhost;dbname='.$GLOBALS['config']['DataBaseName'], 'root', '', $pdo_options);
            }
            return self::$instance;
        }


        // Sql::Get('user', 'id', 'test_id');
        public static function Get($table, $row = '1', $where = '1') {
            $db = Sql::getInstance();

            try {
                $req = $db->prepare("SELECT * FROM $table WHERE $row = :where");
                $req->execute([':where' => $where]);
                $res = $req->fetchall();
            } catch( PDOException $Exception ) {
                return $Exception->getMessage();
            }

            return $res;
        }


        // Sql::Save('user', [
        //     'id' => 'test_id',
        //     'name' => 'test_name',
        //     'password' => 'test_password',
        //     'salt' => 'test_salt',
        //     'role' => 1,
        // ]);
        public static function Save($table, $values) {
            $db = Sql::getInstance();

            $vals = '';
            $names = '';
            $exec_arr = [];

            foreach ($values as $key => $value) {
                if ( array_search($key, array_keys($values)) !== count($values)-1 ) {
                    $names = $names . $key . ', ';
                    $vals = $vals . ':' . $key . ', ';
                } else {
                    $names = $names . $key;
                    $vals = $vals . ':' . $key;
                }
                $exec_arr[':'.$key] = $value;
            }

            try {
                $req = $db->prepare("INSERT INTO $table ($names) VALUES ($vals)");
                $req->execute($exec_arr);
            } catch( PDOException $Exception ) {
                return $Exception->getMessage();
            }

            return true;
        }


        // Sql::Update('user', 'id',  'test', [
        //     'name' => 'test_name',
        //     'password' => 'test_password',
        //     'salt' => 'test_slat',
        // ]);
        public static function Update($table, $row, $where, $values) {
            $db = Sql::getInstance();

            $changes = '';
            $exec_arr = [
                ':where' => $where
            ];

            foreach ($values as $key => $value) {
                if ( array_search($key, array_keys($values)) !== count($values)-1 ) {
                    $changes = $changes . $key . ' = :' . $key . ', ';
                } else {
                    $changes = $changes . $key . ' = :' . $key;
                }
                $exec_arr[':'.$key] = $value;
            }

            try {
                $req = $db->prepare("UPDATE $table SET $changes WHERE $row = :where");
                $req->execute($exec_arr);
            } catch( PDOException $Exception ) {
                return $Exception->getMessage();
            }

            return true;
        }


        // Sql::Delete('user', 'id', 'test_id');
        public static function Delete($table, $row, $where) {
            if (isset($row) && isset($where)) {
                $db = Sql::getInstance();

                try {
                    $req = $db->prepare("DELETE FROM $table WHERE $row = :where");
                    $req->execute([':where' => $where]);
                    // $res = $req->fetch();
                } catch( PDOException $Exception ) {
                    return $Exception->getMessage();
                }

                return true;
            } else {
                return '$row and/or $where not set.';
            }
        }
    }
?>
