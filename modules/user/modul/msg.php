<?php

namespace Modules\User\Modul;
use \Modules\User\Modul\User;
class Msg{
    public $user;
    private $token;
    public static $status;
    public static $msg;
    public static $type;


    public static function include($status,$msg,$type){
        self::$status= $status;
        self::$msg= $msg;
        self::$type= $type;
    }
    
}

    
