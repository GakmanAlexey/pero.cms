<?php

namespace Modules\User\Modul;
use \Modules\User\Modul\User;
class Send{
   

    public function login(){
        $telegram = new \Modules\Telegram\Modul\Telegram(\Modules\Core\Modul\Env::get("TG_KEY") );
        $telegram->select_chat(\Modules\Core\Modul\Env::get("TG_CHAT") ) ;
        $result = $telegram->send_message('Пользователь аторизовался! id:'. \Modules\User\Modul\Msg::$id );
    }
    public function register(){
        $telegram = new \Modules\Telegram\Modul\Telegram(\Modules\Core\Modul\Env::get("TG_KEY") );
        $telegram->select_chat(\Modules\Core\Modul\Env::get("TG_CHAT") ) ;
        $result = $telegram->send_message('Зарегестрировался новый пользователь! id:'. \Modules\User\Modul\Msg::$id." login: ". \Modules\User\Modul\Msg::$login." email: ".\Modules\User\Modul\Msg::$email );
    
        $result = \Modules\Mail\Modul\Mail::send(
    \Modules\User\Modul\Msg::$email,
    'Регистрация',
    'Спасибо что прошли регистрацию '.\Modules\User\Modul\Msg::$token_reg 
);
    
    }
    
}

    
