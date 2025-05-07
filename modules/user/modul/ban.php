<?php

namespace Modules\User\Modul;

class Ban{
    public $user ;
    public function set_ban(){
        $pdo = \Modules\Core\Modul\Sql::connect(); 
        $stmt3 = $pdo->prepare("UPDATE " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "users SET is_banned = ?,ban_reason = ?,ban_expiry_date = ? WHERE username = ? ");
        $ban_data =$this->user->get_ban_reason();
        $expires_at = date('Y-m-d H:i:s', $ban_data["expiry_ban"] + time());
        $stmt3->execute([$ban_data["status_ban"], $ban_data["reason_ban"], $expires_at, $this->user->get_username()]);
        return $stmt3->rowCount() > 0;
        
    } 

    public function unban(){
        $pdo = \Modules\Core\Modul\Sql::connect(); 
        $stmt3 = $pdo->prepare("UPDATE " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "users SET is_banned = ?,ban_reason = ?,ban_expiry_date = ? WHERE username = ? ");
        $stmt3->execute([0, "", null, $this->user->get_username()]);
        return $stmt3->rowCount() > 0;        
    } 
    

}

    
