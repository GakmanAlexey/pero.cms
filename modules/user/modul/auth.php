<?php

namespace Modules\User\Modul;
use \Modules\User\Modul\User;
class Auth{
    private $user;
    private $token;

    public function __construct(){
        $this->user = new User();
    }

    public function set_user($username,$password){
        $this->user
            ->set_username($username)
            ->set_password($password);

        return $this;
    }

    public function auth(){                 
        $pdo = \Modules\Core\Modul\Sql::connect();   

        try {
            $stmt = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "users WHERE username = ?");
            $stmt->execute([$this->user->get_username()]);
            $user_data = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$user_data) {
                return ['success' => false, 'error' => 'Пользователь не найден'];
            }

            if (!$user_data['is_active']) {
                return ['success' => false, 'error' => 'Аккаунт деактивирован'];
            }
            $enc = new \Modules\User\Modul\Encoder;
            if (!$enc->verify($this->user->get_password(), $user_data['password_hash'])) {
                return ['success' => false, 'error' => 'Неверный пароль'];
            }

            $this->user->set_id($user_data['id']);
            return [
                'success' => true,
                'id' => $user_data['id'],
                'username' => $user_data['username'],
                'email' => $user_data['email']
            ];
            
        } catch (\PDOException $e) {
            return ['success' => false, 'error' => 'Ошибка базы данных: ' . $e->getMessage()];
        }
    }

    public function set_session($user_id,$username){
        $_SESSION["id"] = $user_id;
        $_SESSION["username"] = $username;   
        return $this;     
    }

    public function insert_token($user_id){ 
        $enc = new \Modules\User\Modul\Encoder;
        $pdo = \Modules\Core\Modul\Sql::connect(); 
        $this->token = $enc->create_token(40);
        $expires_at = date('Y-m-d H:i:s', strtotime('+30 days'));
        $ip_address = $_SERVER['REMOTE_ADDR'] ?? null;
        $stmt = $pdo->prepare("
            INSERT INTO " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "user_sessions 
            (user_id, token, expires_at, ip_address)
            VALUES (:user_id, :token, :expires_at, :ip_address)
        ");
        $stmt->execute([
            ':user_id' => $user_id,
            ':token' => $this->token,
            ':expires_at' => $expires_at,
            ':ip_address' => $ip_address
        ]);
        return $this;
    }

    public function set_cookie(){ 
        $cookie_name = 'user_token';
        $cookie_value = $this->token; 
        $cookie_expire = time() + (30 * 24 * 60 * 60); 
        $cookie_path = '/';
        $cookie_secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'); 
        $cookie_http_only = true;
        $cookie_same_site = 'Strict';
        setcookie(
            $cookie_name,
            $cookie_value,
            [
                'expires' => $cookie_expire,
                'path' => $cookie_path,
                'secure' => $cookie_secure,
                'httponly' => $cookie_http_only,
                'samesite' => $cookie_same_site
            ]
        );
        return $this;
    }
    

}

    
