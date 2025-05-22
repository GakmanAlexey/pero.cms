<?php

namespace Modules\Mail\Modul;

class Config{
    private static $host;
    private static $port;
    private static $username;
    private static $password;
    private static $encryption;
    private static $from_email;
    private static $from_name;
    private static $timeout;
    private static $is_initialized = false;
    
    private static function initialize() {
        if (!self::$is_initialized) {
            self::$host = \Modules\Core\Modul\Env::get('MAIL_SMTP_HOST');
            self::$port = \Modules\Core\Modul\Env::get('MAIL_SMTP_PORT');
            self::$username = \Modules\Core\Modul\Env::get('MAIL_SMTP_USER');
            self::$password = \Modules\Core\Modul\Env::get('MAIL_SMTP_PASS');
            self::$encryption = \Modules\Core\Modul\Env::get('MAIL_SMTP_ENCRYPTION');
            self::$from_email = \Modules\Core\Modul\Env::get('MAIL_SMTP_FROM_EMAIL');
            self::$from_name = \Modules\Core\Modul\Env::get('MAIL_SMTP_FROM_NAME');
            self::$timeout = \Modules\Core\Modul\Env::get('MAIL_SMTP_TIMEOUT');
            self::$is_initialized = true;
        }
    }
    public static function get_host(){
        self::initialize();
        return self::$host;
    }

    public static function get_port(){
        self::initialize();
        return self::$port;
    }

    public static function get_username(){
        self::initialize();
        return self::$username;
    }

    public static function get_password(){
        self::initialize();
        return self::$password;
    }

    public static function get_encryption(){
        self::initialize();
        return self::$encryption;
    }

    public static function get_from_email(){
        self::initialize();
        return self::$from_email;
    }

    public static function get_from_name(){
        self::initialize();
        return self::$from_name;
    }

    public static function get_timeout(){
        self::initialize();
        return self::$timeout;
    }

    public static function get_all_config(){
        self::initialize();
        return [
            'host' => self::$host,
            'port' => self::$port,
            'username' => self::$username,
            'password' => self::$password,
            'encryption' => self::$encryption,
            'from_email' => self::$from_email,
            'from_name' => self::$from_name,
            'timeout' => self::$timeout
        ];
    }
    
}