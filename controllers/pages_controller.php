<?php
    class pagesController {

        public function home() {

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

        public function error() {
            Base::Render('pages/error');
        }
    }
?>
