<?php
    require_once "models/game.php";

    class adminController {
        public static function info($var) {
            $id = Base::Sanitize( $var[2] );
            $game = Game::Find($id);
            $views = Game::getViews($id);
            $max = 0;

            if ( !$GLOBALS['config']['Debug'] ) {
                $view_dates = [
                    date("Y-m-d", strtotime("-6 days")) => 0,
                    date("Y-m-d", strtotime("-5 days")) => 0,
                    date("Y-m-d", strtotime("-4 days")) => 0,
                    date("Y-m-d", strtotime("-3 days")) => 0,
                    date("Y-m-d", strtotime("-2 days")) => 0,
                    date("Y-m-d", strtotime("-1 days")) => 0,
                    date("Y-m-d") => 0,
                ];
                
                foreach($views as $view) {
                    if ( isset( $view_dates[date("Y-m-d", strtotime($view['time']))] ) ) {
                        $view_dates[date("Y-m-d", strtotime($view['time']))] = $view_dates[date("Y-m-d", strtotime($view['time']))] + 1;
                        if ($view_dates[date("Y-m-d", strtotime($view['time']))] > $max) {
                            $max = $view_dates[date("Y-m-d", strtotime($view['time']))];
                        }
                    }
                }

                foreach ($view_dates as $key => $value) {
                    $view_dates[$key] = abs((($value/$max) * 350) - 350);
                }    
            } else {
                $view_dates = [
                    date("Y-m-d", strtotime("-6 days")) => mt_rand(10, 340),
                    date("Y-m-d", strtotime("-5 days")) => mt_rand(10, 340),
                    date("Y-m-d", strtotime("-4 days")) => mt_rand(10, 340),
                    date("Y-m-d", strtotime("-3 days")) => mt_rand(10, 340),
                    date("Y-m-d", strtotime("-2 days")) => mt_rand(10, 340),
                    date("Y-m-d", strtotime("-1 days")) => mt_rand(10, 340),
                    date("Y-m-d") => mt_rand(10, 340),
                ];
                $max = 350;
            }
            

            Base::Render('admin/info', [
                'views' => $view_dates,
                'max' => $max
            ]);
        }
    }