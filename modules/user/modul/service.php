<?php

namespace Modules\User\Modul;

class Service{
    public $msg = [];
    public $id ;
    public function register(){
        if(isset($_POST["username"],$_POST["email"],$_POST["password"],$_POST["password2"])){
            $verf = new \Modules\User\Modul\Verification();
            $verf->register($_POST["username"],$_POST["email"],$_POST["password"],$_POST["password2"]);
            if(!$verf->status){
                $this->msg = $verf->msg;
                return false;
            }

            $enc = new \Modules\User\Modul\Encoder;
            $password_hash = $enc->hash($_POST["password"]);

            $reg = new \Modules\User\Modul\Register();
            $reg->set_user($_POST["username"],$_POST["email"],$password_hash);
            $res = $reg->register();

            if($res['success']){
                $this->id = $res['userId'];
                return true;
            }else{
                $this->msg[] = $res["error"];
                return $res['success'];
            }
        }else{
            $config = \Modules\User\Modul\Config::get_instance();
            $this->msg[] = $config->get_message('server_error');
            return false;
        }

    }
    public function auth(){
        if(isset($_POST["username"],$_POST["password"])){
            $verf = new \Modules\User\Modul\Verification();
            $verf->login($_POST["username"],$_POST["password"]);
            if(!$verf->status){
                $this->msg = $verf->msg;
                return false;
            }
            $log = new \Modules\User\Modul\Auth();
            $log->set_user($_POST["username"],$_POST["password"]);
            $res = $log->auth();
            if($res['success']){
                $this->id = $res['id'];
            }else{
                $this->msg[] = $res["error"];
                return $res['success'];
            }

            $log->set_session($res['id'],$res['username'])
                ->insert_token($res['id'])
                ->set_cookie();
            return true;

        }else{
            $config = \Modules\User\Modul\Config::get_instance();
            $this->msg[] = $config->get_message('server_error');
            return false;
        }
        
    }
    public function logout(){
        unset($_SESSION["id"]);
        unset($_SESSION["username"]);

        $cookie_name = 'user_token';
        $cookie_path = '/';
        $cookie_secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
        $cookie_http_only = true;
        $cookie_same_site = 'Strict';
    
        setcookie(
            $cookie_name,
            '', 
            [
                'expires' => time() - 3600, 
                'path' => $cookie_path,
                'secure' => $cookie_secure,
                'httponly' => $cookie_http_only,
                'samesite' => $cookie_same_site
            ]
        );
        unset($_COOKIE[$cookie_name]);
        
    }

    public function auth_to_cookie(){
        if(isset($_SESSION["id"]) and ($_SESSION["id"] >= 1)) return false;
        $log = new \Modules\User\Modul\Auth();
        $log->auth_to_cookie();
    }
    
    public function delete(){
        
    }
    public function ban(){
        
    }
    public function unban(){
        
    }
}