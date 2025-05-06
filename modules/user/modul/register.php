<?php

namespace Modules\User\Modul;
use \Modules\User\Modul\User;
class Register{
    private $user;

    public function __construct(){
        $this->user = new User();
    }

    public function set_user($username,$email,$password_hash,$is_active = true){
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
    

}

    
