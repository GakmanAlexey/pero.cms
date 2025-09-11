<?php

namespace Modules\User\Modul;

class Guest{
    public static $id ;
    
    public static function start(){
        if(isset( $_SESSION["guest"])){
            self::$id = $_SESSION["guest"];
            return;
        }
        if(isset($_COOKIE['guest'])){
            self::$id = $_COOKIE["guest"];
            $_SESSION["guest"] = self::$id;
            return;
        }
        self::create();
    }

    public static function create() {
        $length = 20;
        $randomString = bin2hex(random_bytes($length / 2));
        $randomString = substr(preg_replace('/[^a-z0-9]/', '', base64_encode($randomString)), 0, $length);
        $_SESSION["guest"] = $randomString;
        setcookie('guest', $randomString, time() + (365 * 24 * 60 * 60), '/');
        self::$id = $randomString;
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
    
    public static function destroy() {
        self::$id = null;
        unset($_SESSION["guest"]);
        setcookie('guest', '', time() - 3600, '/');
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
    
    public static function getId() {
        if (self::$id === null) {
            self::start();
        }
        return self::$id;
    }
}

    
