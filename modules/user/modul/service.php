<?php

namespace Modules\User\Modul;

class Service{
    public $msg = [];
    public $id ;
    public $user;
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
            $this->user = new \Modules\User\Modul\Auth();
            $this->user->user->set_username($_POST["username"])
                ->set_password($_POST["password"]);
            $verf = new \Modules\User\Modul\Verification();
            $verf->login($this->user->user->get_username(),$this->user->user->get_password());
            if(!$verf->status){
                $this->msg = $verf->msg;
                return false;
            }

            $res = $this->user->auth();

            if($res['success']){
                $this->id = $this->user->user->get_id();
            }else{
                $this->msg[] = $res["error"];
                return $res['success'];
            }

            $this->user->set_session($this->user->user->get_id(),$this->user->user->get_username())
                ->insert_token($this->user->user->get_id())
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

    public function ban(){
        if(isset($_POST["username"],$_POST["reason_ban"],$_POST["expiry_ban"])){
            $this->user = new \Modules\User\Modul\User();
            $this->user->set_username($_POST["username"])
                ->set_ban(true, $_POST["reason_ban"], $_POST["expiry_ban"]);
            $ban = new \Modules\User\Modul\Ban;
            $ban->user = $this->user;
            $ban->set_ban();
        }else{
            $config = \Modules\User\Modul\Config::get_instance();
            $this->msg[] = $config->get_message('server_error');
            return false;
        }
    }

    public function unban(){
        if(isset($_POST["username"])){
            $this->user = new \Modules\User\Modul\User();
            $this->user->set_username($_POST["username"])
                ->un_ban();
            $ban = new \Modules\User\Modul\Ban;
            $ban->user = $this->user;
            $ban->unban();
        }else{
            $config = \Modules\User\Modul\Config::get_instance();
            $this->msg[] = $config->get_message('server_error');
            return false;
        }
    }
}