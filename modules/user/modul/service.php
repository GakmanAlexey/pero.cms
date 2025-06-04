<?php

namespace Modules\User\Modul;

class Service  extends \Modules\Abs\Handler{
    public $msg = [];
    public $type;
    public $id ;
    public $user;
    public function register(){
        if(isset($_POST["username"],$_POST["email"],$_POST["password"],$_POST["password2"])){
            $verf = new \Modules\User\Modul\Verification();
            $verf->register($_POST["username"],$_POST["email"],$_POST["password"],$_POST["password2"]);
            if(!$verf->status){
                $this->msg = $verf->msg;
                $this->type = $verf->type;
                return false;
            }
            $enc = new \Modules\User\Modul\Encoder;
            $password_hash = $enc->hash($_POST["password"]);

            $reg = new \Modules\User\Modul\Register();
            $reg->set_user($_POST["username"],$_POST["email"],$password_hash);
            $res = $reg->register();

            if($res['success']){
                $this->id = $res['userId'];
                \Modules\User\Modul\Msg::$id = $this->id;
                \Modules\User\Modul\Msg::$login = $_POST["username"];
                \Modules\User\Modul\Msg::$email = $_POST["email"];
                \Modules\User\Modul\Msg::$token_reg = $reg->create_token();
                $this->set_addres(APP_ROOT.DS."modules".DS."user".DS."modul".DS)->handl("register");
                return true;
            }else{
                $this->msg[] = $res["error"];
                $this->type = $res["type"];
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
                $this->type = $verf->type;
                return false;
            }

            $res = $this->user->auth();

            if($res['success']){
                $this->id = $this->user->user->get_id();
            }else{
                $this->msg[] = $res["error"];
                $this->type = $res["type"];
                return $res['success'];
            }
            \Modules\User\Modul\Msg::$id = $this->id;
            $this->set_addres(APP_ROOT.DS."modules".DS."user".DS."modul".DS)->handl("login");
            $this->user->set_session($this->user->user->get_id(),$this->user->user->get_username())
                ->insert_token($this->user->user->get_id())
                ->set_cookie();
            return true;

        }else{
            $config = \Modules\User\Modul\Config::get_instance();
            $this->msg[] = $config->get_message('server_error');
            $this->type = "username";
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

    public function verification(){
        if(isset($_GET["key"]) AND ($_GET["key"] != "")){
            $reg = new \Modules\User\Modul\Register();
            return $reg -> verification();
        }else{
            return false;
        }
    }
    public function recover(){
        if(isset($_POST["username"])){
            $this->user = new \Modules\User\Modul\User();
            $this->user->set_username($_POST["username"]);
            $verf = new \Modules\User\Modul\Verification();
            $verf->ver_username($this->user->get_username());
            
            if(!$verf->status){
                $this->msg = $verf->msg;
                $this->type = $verf->type;
                return false;
            }

            $rec = new \Modules\User\Modul\Recover();
            $rec->set_login($this->user->get_username());
            $res = $rec->recover();
            if(!$res['success']){
                $this->msg[] = $res["error"];
                $this->type = "username";
                return $res['success'];
            }
            \Modules\User\Modul\Msg::$id = $res["user"]->get_id();
            \Modules\User\Modul\Msg::$login = $res["user"]->get_username();
            \Modules\User\Modul\Msg::$email = $res["user"]->get_email();
            \Modules\User\Modul\Msg::$token_reg = $rec->create_token();
            $this->set_addres(APP_ROOT.DS."modules".DS."user".DS."modul".DS)->handl("recover");
            return true;

        }else{
            return false;
        }
    }
    public function recover2(){
         if(isset($_GET["key"]) AND ($_GET["key"] != "")){
            $rec = new \Modules\User\Modul\Recover();
            $rec -> set_token($_GET["key"]);
            return $rec -> step2();
        }else{
            return false;
        }
            
    }

    public function recover2_2(){
        if(isset($_POST["password"],$_POST["password2"])){
            $verf = new \Modules\User\Modul\Verification();
            $verf->ver_password($_POST["password"])
                ->ver_passwords_match($_POST["password"], $_POST["password2"]);
            if(!$verf->status){
                $this->msg = $verf->msg;
                $this->type = $verf->type;
                return false;
            }
            $rec = new \Modules\User\Modul\Recover;
            $rec -> set_token($_GET["key"]);
            return $rec -> set_new_password();
        }else{
            $config = \Modules\User\Modul\Config::get_instance();
            $this->msg[] = $config->get_message('server_error');
            return false;
        }
    }

    public function save_edit_admin(){
        if(isset($_POST["save_boot"]) and $_POST["save_boot"]=="save"){
            $verf = new \Modules\User\Modul\Verification();
            $result = $verf->ver_username($_POST["username"]);
            if(!$verf->status){
                return $result;
            }
            $result = $verf->ver_email($_POST["mail"]);
            if(!$verf->status){
                return $result;
            }

            $pdo = \Modules\Core\Modul\Sql::connect();  
            if($_POST["password"] != "********"){
                $result = $verf->ver_password($_POST["password"]);  
                $enc = new \Modules\User\Modul\Encoder;
                $password_hash = $enc->hash($_POST["password"]);
                $stmt = $pdo->prepare("UPDATE " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "users 
                            SET password_hash = ? 
                            WHERE id = ?");
                $result = $stmt->execute([$password_hash, $_GET["id"]]);   
                return true;           
            }
            $stmt = $pdo->prepare("UPDATE " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "users 
                            SET username = ?,  email = ?
                            WHERE id = ?");
            $result = $stmt->execute([$_POST["username"],$_POST["mail"], $_GET["id"]]);  
                return true;       
        }
         return $this;
    }
}