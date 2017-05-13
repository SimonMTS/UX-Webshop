<?php

    // class db {
    //     public static function init() {
    //         $mongo = new MongoClient($GLOBALS['config']['mongodb']);
    //
    //         return $mongo->tovuti;
    //     }
    // }
    //
    // class Redirect {
    //     public static function to($url) {
    //         if (headers_sent()) {
    //             echo '<meta http-equiv="Location" content="' . $url . '">';
    //             echo '<script> location.replace("' . $url . '"); </script>';
    //             echo '<a href="' . $url . '">' . $url . '</a>';
    //             exit;
    //         } else {
    //             header('location: ' . $url);exit;
    //         }
    //     }
    // }

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
            require_once('views/layout.php');
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

        public static function Get($table, $row = '1', $where = '1') {
            $db = Sql::getInstance();

            try {
                $req = $db->prepare("SELECT * FROM $table WHERE $row = :where");
                $req->execute([':where' => $where]);
                $res = $req->fetch();   
            } catch( PDOException $Exception ) {
                return $Exception->getMessage();
            }

            return $res;
        }

        public static function Save() {

        }

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
