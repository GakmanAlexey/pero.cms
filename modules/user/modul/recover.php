<?php

namespace Modules\User\Modul;
use \Modules\User\Modul\User;
class Recover{
    private $user;
    private $token;

    public function __construct(){
        $this->user = new User();
    }

    public function set_login($username){
        $this->user->set_username($username);
        return $this;
    }
    public function recover(){
        $pdo = \Modules\Core\Modul\Sql::connect();  
        $stmt = $pdo->prepare("SELECT * FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."users WHERE username = ?");
        $stmt->execute([$this->user->get_username()]);
        $user_data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$user_data) {
            return ['success' => false, 'error' => 'Пользователь с таким логином не существует'];
        }
        $this->user->set_id($user_data["id"])
            ->set_username($user_data["username"])
            ->set_email($user_data["email"]);
        
        return ['success' => true, 'user' => $this->user];
    }
    public function create_token(){
        $pdo = \Modules\Core\Modul\Sql::connect();  
        $expires_at = date('Y-m-d H:i:s', strtotime('+1 days'));

        $enc = new \Modules\User\Modul\Encoder;
        $this->token = $enc->create_token(40);

        $stmt = $pdo->prepare("INSERT INTO ".\Modules\Core\Modul\Env::get("DB_PREFIX")."password_reset_tokens (user_id, token, expires_at) VALUES (?, ?, ?)");
        $result = $stmt->execute([$this->user->get_id(), $this->token, $expires_at]);
        return $this->token;
    }


}

    
