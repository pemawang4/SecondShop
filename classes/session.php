<?php 
    class Session{
        public static function start(){
            if(!isset($_SESSION)){ 
                session_start(); 
            } 
        }

        public static function set($key, $val){
            $_SESSION[$key] = $val;
        }

        public static function get($key){
            if(isset($_SESSION[$key])){
                return $_SESSION[$key];
            }else{
                return false;
            }
        }

        public static function destroy(){
            session_unset();
            session_destroy();
            header("Location: login.php");
        }
    }

    $session = new Session;
?>