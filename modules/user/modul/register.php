<?php

namespace Modules\User\Modul;
use \Modules\User\Modul\User;
class Register{
    private $user;
    private $token;

    public function __construct(){
        $this->user = new User();
    }

    public function set_user($username,$email,$password_hash,$is_active = 0){
        $this->user
            ->set_username($username)
            ->set_email($email)
            ->set_password_hash($password_hash)
            ->set_is_active($is_active);

        return $this;
    }

    public function register(){                 
        $pdo = \Modules\Core\Modul\Sql::connect();   

        try {
            $stmt = $pdo->prepare("SELECT id FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."users WHERE username = ?");
            $stmt->execute([$this->user->get_username()]);
            
            if ($stmt->fetch()) {
                return ['success' => false, 'error' => 'Пользователь с таким именем или email уже существует'];
            }

            $stmt = $pdo->prepare("INSERT INTO ".\Modules\Core\Modul\Env::get("DB_PREFIX")."users (username, email, password_hash, is_active) VALUES (?, ?, ?, ?)");
            $result = $stmt->execute([$this->user->get_username(), $this->user->get_email(), $this->user->get_password_hash(), $this->user->get_active()]);

            if ($result && $stmt->rowCount() > 0) {
                $id = $pdo->lastInsertId();
                $this->user->set_id($id);
                return ['success' => true, 'userId' => $id];
            }
            $this->user->set_id(0);            
            return ['success' => false, 'error' => 'Ошибка при регистрации'];
            
        } catch (\PDOException $e) {
            return ['success' => false, 'error' => 'Database error: '.$e->getMessage()];
        }
    }

    public function create_token(){
        $pdo = \Modules\Core\Modul\Sql::connect();  
        $expires_at = date('Y-m-d H:i:s', strtotime('+1 days'));

        $enc = new \Modules\User\Modul\Encoder;
        $this->token = $enc->create_token(40);

        $stmt = $pdo->prepare("INSERT INTO ".\Modules\Core\Modul\Env::get("DB_PREFIX")."user_register_token (user_id, token, expires_at) VALUES (?, ?, ?)");
        $result = $stmt->execute([$this->user->get_id(), $this->token, $expires_at]);

        return $this->token;
    }

    public function verification(){
        $pdo = \Modules\Core\Modul\Sql::connect(); 

        $token = $_GET["key"] ?? null;
        if (empty($token)) {
            return false;
        }

        $stmt = $pdo->prepare("SELECT `user_id` FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "user_register_token WHERE (token = ?) AND (expires_at > CURRENT_TIMESTAMP());");
        $stmt->execute([$token]);                  
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if ($result) {
            $user_id = $result['user_id'];
        } else {
           return false;
        }

        $stmt = $pdo->prepare("
            UPDATE " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "users 
            SET is_active = 1 
            WHERE id = ?
        ");
        $stmt->execute([$user_id]);

        $stmt = $pdo->prepare("
            DELETE FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "user_register_token 
            WHERE token = ?
        ");
        $stmt->execute([$_GET["key"]]);
        return true;
    }
    

}

    
