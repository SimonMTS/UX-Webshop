<?php
    class pagesController {

        public function home() {

            if (isset($_SESSION['user']['name'])) {
                $name = $_SESSION['user']['name'];
            } else {
                $name = 'bezoeker';
            }

            var_dump( Sql::Delete('user', 'name', 'test1') );exit;

            Base::Render('pages/home.php', [
                'name' => $name
            ]);
        }

        public function error() {
            Base::Render('pages/error.php');
        }

        // public function faq() {
        //     require_once('views/pages/faq.php');
        // }
    }
?>
