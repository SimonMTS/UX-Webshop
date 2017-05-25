<?php
    class pagesController {

        public static function home() {

            if (isset($_SESSION['user']['name'])) {
                $name = $_SESSION['user']['name'];
            } else {
                $name = 'bezoeker';
            }

            Base::Render('pages/home', [
                'page_title' => 'Home',
                'name' => $name
            ]);
        }

        public static function error() {
            Base::Render('pages/error');
        }
    }
?>
