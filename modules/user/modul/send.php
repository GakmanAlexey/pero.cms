<?php

namespace Modules\User\Modul;
use \Modules\User\Modul\User;
class Send{
   

    public function login(){
        $telegram = new \Modules\Telegram\Modul\Telegram(\Modules\Core\Modul\Env::get("TG_KEY") );
        $telegram->select_chat(\Modules\Core\Modul\Env::get("TG_CHAT") ) ;
        $result = $telegram->send_message('Пользователь аторизовался! id:'. \Modules\User\Modul\Msg::$id );
    }
    
}

    
