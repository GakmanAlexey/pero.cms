<?php

namespace Modules\User\Modul;
use \Modules\User\Modul\User;
class Auth{
    public $user;
    private $token;
    public $status;
    public $msg;
    public $type;

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
                return ['success' => false, 'error' => 'Пользователь не найден', 'type' => "username"];
            }

            if (!$user_data['is_active']) {
                return ['success' => false, 'error' => 'Аккаунт деактивирован', 'type' => "username"];
            }
            $enc = new \Modules\User\Modul\Encoder;
            if (!$enc->verify($this->user->get_password(), $user_data['password_hash'])) {
                return ['success' => false, 'error' => 'Неверный пароль', 'type' => "password"];
            }

            if ($user_data['is_banned']) {
                $this->user->set_ban($user_data['is_banned'], $user_data['ban_reason'], $user_data['ban_expiry_date']);
                return ['success' => false, 'error' => 'Аккаунт заблокирован', 'type' => "username"];
            }
            $this->user->set_id($user_data['id'])
                ->set_email($user_data['email']);
            
            return ['success' => true];
            
        } catch (\PDOException $e) {
            return ['success' => false, 'error' => 'Ошибка базы данных: ' . $e->getMessage(), 'type' => "login"];
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
    
    public function refresh_cookie(){
        $cookie_name = 'user_token';
        
        if (!isset($_COOKIE[$cookie_name])) {
            return $this;
        }
    
        setcookie(
            $cookie_name,
            $_COOKIE[$cookie_name], 
            [
                'expires' => time() + (30 * 24 * 60 * 60), 
                'path' => '/',
                'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
                'httponly' => true,
                'samesite' => 'Strict'
            ]
        );
    
        return $this;
    }

    public function auth_to_cookie(){
        $cookie_name = 'user_token';

        if (!isset($_COOKIE[$cookie_name])) {
            return false;
        }

        $token = $_COOKIE[$cookie_name];

        $pdo = \Modules\Core\Modul\Sql::connect(); 

        $stmt = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "user_sessions WHERE token = ? LIMIT 1");
        $stmt->execute([$token]);
        $token_data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$token_data) {
            return false;
        }

        $stmt2 = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "users WHERE id = ? LIMIT 1");
        $stmt2->execute([$token_data["user_id"]]);
        $user_data = $stmt2->fetch(\PDO::FETCH_ASSOC);

        if (!$user_data) {
            return false;
        }
        $this->set_session($user_data["id"],$user_data["username"])
            ->refresh_cookie();
         
        $expires_at = date('Y-m-d H:i:s', strtotime('+30 days'));
        $stmt3 = $pdo->prepare("UPDATE " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "user_sessions SET expires_at = ? WHERE token = ? ");
        $stmt3->execute([$expires_at, $token]);
            return $stmt->rowCount() > 0;
    }
}

    
