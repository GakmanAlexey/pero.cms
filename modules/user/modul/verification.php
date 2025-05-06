<?php

namespace Modules\User\Modul;

class Verification{
    public $status = false;
    public $msg = [];
    private $config;

    public function __construct(){
        $this->config = \Modules\User\Modul\Config::get_instance();
    }
    public function register($username,$email, $password,$password2){
        $this->msg =  [];
        $this->status =  true;
        $this->ver_username($username)
            ->ver_username_free($username)
            ->ver_email($email)
            ->ver_password($password)
            ->ver_passwords_match($password,$password2);
        return $this;
    }

    public function ver_username($username){
        if(mb_strlen($username) < $this->config->get('limits->min_username') ){
            $this->status = false;
            $this->msg[] = $this->config->get_message('username_too_short', [
                'min_username' => $this->config->get('limits->min_username')
            ]);
            return $this;
        }
        if(mb_strlen($username) > $this->config->get('limits->max_username') ){
            $this->status = false;
            $this->msg[] = $this->config->get_message('username_too_long', [
                'max_username' => $this->config->get('limits->max_username')
            ]);
            return $this;
        }
        return $this;
    }

    public function ver_username_free($username){
        $pdo = \Modules\Core\Modul\Sql::connect();        
        $stmt = $pdo->prepare("SELECT id FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."users WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
            
        if ($stmt->fetch()) {
            $this->status = false;
            $this->msg[] = $this->config->get_message('username_taken');
        }
        return $this;
    }

    public function ver_email($email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->status = false;
            $this->msg[] = $this->config->get_message('email_invalid');
            return $this;
        }

        $domain = explode("@", $email)[1];
        if (!checkdnsrr($domain, "MX") && !checkdnsrr($domain, "A")) {
            $this->status = false;
            $this->msg[] = $this->config->get_message('email_invalid');
            return $this;
        }

        if (strlen($email) > 254 || strpos($email, "..") !== false) {
            $this->status = false;
            $this->msg[] = $this->config->get_message('email_invalid');
            return $this;
        }
        return $this;
    }

    public function ver_password($password){
        if(mb_strlen($password) < $this->config->get('limits->min_pass') ){
            $this->status = false;
            $this->msg[] = $this->config->get_message('password_too_short', [
                'min_pass' => $this->config->get('limits->min_pass')
            ]);
            return $this;
        }
        if(mb_strlen($password) > $this->config->get('limits->max_pass') ){
            $this->status = false;
            $this->msg[] = $this->config->get_message('password_too_long', [
                'max_pass' => $this->config->get('limits->max_pass')
            ]);
            return $this;
        }
        return $this;
    }

    public function ver_passwords_match($password, $password2){
        if($password !=  $password2){
            $this->status = false;
            $this->msg[] = $this->config->get_message('passwords_dont_match');
        }
        return $this;
    }

}

    
