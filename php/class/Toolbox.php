<?php
    defined('APPLICATION') OR exit('Accès interdit');
    class Toolbox {
        // Check if array hasn't a empty value
        public static function ArrayHasValue($array, $keys) {
            foreach($keys as $key) {
                if(!isset($array[$key])) {
                    return false;  
                }
            }
            return true;
        }

        public static function RedirectToHome() {
            self::Redirect('index.php');
        }
        
        // Redirect with get parameters (array(... => ...))
        public static function Redirect($url, $params = null) {
            if(isset($params)) {
                $str = '';
                foreach($params as $key => $value) {
                    $str .= (!empty($str) ? '&' : '').$key.'='.$value;
                }
            }
            header('Location: '.$url.(isset($str) ? '?'.$str : ''));
        }

        // Redirect to the current page (Don't recommend to use)
        public static function RedirectToCurrentPage() {
            if(isset($_SERVER['HTTP_REFERER'])){
                self::Redirect($_SERVER['HTTP_REFERER']);
            } else {
                self::RedirectToHome();
            }
        }

        public static function IsConnected() {
            return isset($_SESSION['user']);
        }
        
        public static function GetAdmin() {
            return self::IsConnected() ? self::GetUser()->Admin : 0;
        } 

        public static function IsAdmin() {
            return boolval(self::GetAdmin());
        }

        public static function GetUser() {
            return isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;
        }

        public static function Refresh() {
            header('Refresh: 0');
        }
    }