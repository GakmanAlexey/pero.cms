<?php

namespace Modules\Card\Modul;

class Cardcreate{    
    public function create_auth(\Modules\Card\Modul\Card $card){
        $pdo = \Modules\Core\Modul\Sql::connect();
        $guestId =\Modules\User\Modul\Guest::getId();
        $sql = "INSERT INTO " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_card 
        (user_id, guest_id,  created_at, expires_at, ip_address, user_agent) 
        VALUES (?, ?,  NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), ?, ?)";
        $stmt = $pdo->prepare($sql);
        $params = [
            $card->get_user(),                  // user_id = null (для неавторизованного пользователя)
            $guestId,                           // guest_id из сессии/куки
            $_SERVER['REMOTE_ADDR'] ?? null,    // IP адрес
            $_SERVER['HTTP_USER_AGENT'] ?? null // User Agent
        ];

        $stmt->execute($params);
        $card->set_id($pdo->lastInsertId());
        return $card;
       
    } 
    
    
    public function create_no_auth(\Modules\Card\Modul\Card $card){
        $pdo = \Modules\Core\Modul\Sql::connect();
        $sql = "INSERT INTO " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_card 
        (user_id, guest_id,  created_at, expires_at, ip_address, user_agent) 
        VALUES (?, ?,  NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), ?, ?)";
        $stmt = $pdo->prepare($sql);
        $params = [
            null,                  // user_id = null (для неавторизованного пользователя)
            $card->get_guest(),                           // guest_id из сессии/куки
            $_SERVER['REMOTE_ADDR'] ?? null,    // IP адрес
            $_SERVER['HTTP_USER_AGENT'] ?? null // User Agent
        ];

        $stmt->execute($params);
        $card->set_id($pdo->lastInsertId());
        return $card;
    }

    

    
}

    
