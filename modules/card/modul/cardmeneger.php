<?php

namespace Modules\Card\Modul;

class Cardmeneger{ 
    public static $card;   
    public static function load(){
        $card = new \Modules\Card\Modul\Card;
        $load = new \Modules\Card\Modul\Cardload;
        if(isset($_SESSION["id"]) and ($_SESSION["id"] >= 1)){
            //авторизован
            self::$card = $load->load_auth($card);
        }else{
            self::$card = $load->load_no_auth($card);
        }
    }

    public static function save($card){

    }

    
}

    
