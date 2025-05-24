<?php

namespace Modules\User\Modul;

class Taker{
    public $user;

    public function get_from_id($id){
        $this->user = new \Modules\User\Modul\User();

        $pdo = \Modules\Core\Modul\Sql::connect(); 
        $stmt2 = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "users WHERE id = ? LIMIT 1");
        $stmt2->execute([$id]);
        $user_data = $stmt2->fetch(\PDO::FETCH_ASSOC);

        if (!$user_data) {
            $this->user->set_id(0);
        }else{
            $this->user->set_id($user_data["id"]);
            $this->user->set_username($user_data["username"]);
            $this->user->set_is_active($user_data["is_active"]);
            $this->user->set_ban($user_data["is_banned"],$user_data["ban_reason"],$user_data["ban_expiry_date"]);
        }
        return $this->user;

    }

    public function get_from_username($username){
        
    }

}