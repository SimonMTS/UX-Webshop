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

        public static function Render( $view, $Cvar = [] ) {
            foreach ($Cvar as $key => $value) {
                ${$key} = $value;
            }

            $view = $view . '.php';

            require_once(__dir__.'/../views/layout/' . Controller::$layout . '.php');
        }

        public static function Upload_file($file) {
            $target_dir = "assets/img/";
            $target_file = $target_dir . self::Genetate_id().$file['name'] ;
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            
            $check = getimagesize($file["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
            
            if ($file["size"] > 5000000) {
                $uploadOk = 0;
            }
            
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                return false;
            } else {
                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    return $target_file;
                } else {
                    return false;
                }
            }

        }

        public static function Error( $a = null, $b = null, $c = null, $d = null, $e = null, $f = null) { //todo
            $error = error_get_last();
            
            if ( $error["type"] == E_ERROR ) {
                // fatal error
                $data = str_replace( '\\', '|', implode('*', $error) );
                self::error_view('fatal', $data);exit;
            } elseif ( isset($a) && !isset($b) && !isset($c) && !isset($d) && !isset($e) && !isset($f) ) {
                // error
                self::error_view($a->getcode(), $a);exit;
            } else { 
                // exeption
                self::error_view($a, [
                    $a,
                    $b,
                    $c,
                    $d,
                    $e,
                    $f
                ]);exit;
            }
        }

        public static function error_view($type = null, $data = null) {
            Base::Render('pages/error', [
                'type' => $type,
                'data' => $data
            ]);
        }

        public static function Sanitize($string) {
            return htmlentities($string);
        }
        
        public static function Curl() {
            return (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        }

        public static function Genetate_id() {
            return str_replace('.', '', uniqid('', true));;
        }

        public static function Hash_String($string, $salt) {
            return hash('sha512', $string . $salt);
        }
    }

    class Controller {
        public static $layout = 'main';
        public static $title;

        public static function beforeAction() {
            self::$title = $GLOBALS['config']['Default_Title'];
        }
    }

    class Sql {
        private static $instance = NULL;

        private static function getInstance() {
            if (!isset(self::$instance)) {
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                self::$instance = new PDO('mysql:host=localhost;dbname='.$GLOBALS['config']['DataBaseName'], $GLOBALS['config']['DataBase_user'], $GLOBALS['config']['DataBase_password'], $pdo_options);
            }
            return self::$instance;
        }


        // Sql::Get('user', 'id', 'test_id');
        public static function Get($table, $row = '1', $where = '1') {
            $db = self::getInstance();

            try {
                $req = $db->prepare("SELECT * FROM $table WHERE $row = :where");
                $req->execute([':where' => $where]);
                $res = $req->fetchall();
            } catch( PDOException $Exception ) {
                return $Exception->getMessage();
            }

            return $res;
        }

        //Sql::GetSorted('game', 'views', 3)
        public static function GetSorted($table, $row, $limit = 4) {
            $db = self::getInstance();

            if ($limit) {
                try {
                    $req = $db->prepare("SELECT * FROM $table ORDER BY $row DESC LIMIT $limit");
                    $req->execute();
                    $res = $req->fetchall();
                } catch( PDOException $Exception ) {
                    return $Exception->getMessage();
                }
                
                return $res;
            } else {
                try {
                    $req = $db->prepare("SELECT * FROM $table ORDER BY $row DESC");
                    $req->execute();
                    $res = $req->fetchall();
                } catch( PDOException $Exception ) {
                    return $Exception->getMessage();
                }
                
                return $res;
            }
        }

        // Sql::Search('user', 'name', 'beheerder1');
        public static function Search($table, $row = '', $like = '', $limit = 11, $offset = 0) {
            $db = self::getInstance();

            try {
                $req = $db->prepare("SELECT * FROM $table WHERE $row LIKE :like LIMIT $limit OFFSET $offset");
                $req->execute([
                    ':like' => "%".$like."%"
                    ]);
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
            $db = self::getInstance();

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
            $db = self::getInstance();

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
                $db = self::getInstance();

                try {
                    $req = $db->prepare("DELETE FROM $table WHERE $row = :where");
                    $req->execute([':where' => $where]);
                } catch( PDOException $Exception ) {
                    return $Exception->getMessage();
                }

                return true;
            } else {
                return false;
            }
        }

        // Sql::RemoveDB('uxxx');
        public static function RemoveDB($name) {
            if (isset($name) && !empty($name)) {
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $db = new PDO('mysql:host=localhost', $GLOBALS['config']['DataBase_user'], $GLOBALS['config']['DataBase_password'], $pdo_options);

                try {
                    $req = $db->prepare("DROP DATABASE `$name`");
                    $req->execute();
                } catch( PDOException $Exception ) {
                    return $Exception->getMessage();
                }

                return true;
            }
        }

        // Sql::CreateDB('uxxx');
        public static function CreateDB($name) {
            if (isset($name) && !empty($name)) {
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $db = new PDO('mysql:host=localhost', $GLOBALS['config']['DataBase_user'], $GLOBALS['config']['DataBase_password'], $pdo_options);

                try {
                    $req = $db->prepare("CREATE DATABASE `$name`");
                    $req->execute();
                } catch( PDOException $Exception ) {
                    return $Exception->getMessage();
                }

                return true;
            }
        }

        // Sql::CreateTable('game', [
        //     'id' => 'varchar(256)',
        //     'name' => 'varchar(256)',
        //     'price' => 'int(10)',
        //     'descr' => 'longtext',
        //     'cover' => 'varchar(256)',
        //     'views' => 'int(20)'
        // ]);
        public static function CreateTable($dbn, $prop) {
            if (isset($dbn) && !empty($dbn) && isset($prop) && sizeof($prop) > 0) {
                $db = self::getInstance();
                $cols = '';

                foreach ($prop as $key => $value) {
                    $cols = $cols.'`'.$key.'` '.$value;
                    if (sizeof($prop) > sizeof(explode(',', $cols))) {
                        $cols = $cols.', ';
                    }
                }
                
                try {
                    $req = $db->prepare("CREATE TABLE $dbn ( $cols ) ");
                    $req->execute();
                } catch( PDOException $Exception ) {
                    return $Exception->getMessage();
                }

                return true;
            }
        }

        // Sql::AddPKey('game', 'id');
        public static function AddPKey($dbn, $prop) {
            if (isset($dbn) && !empty($dbn) && isset($prop) && !empty($prop)) {
                $db = self::getInstance();
                
                try {
                    $req = $db->prepare("ALTER TABLE `$dbn` ADD PRIMARY KEY(`$prop`)");
                    $req->execute();
                } catch( PDOException $Exception ) {
                    return $Exception->getMessage();
                }

                return true;
            }
        }
    }