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
        
    }
    public function delete(){
        
    }
    public function ban(){
        
    }
    public function unban(){
        
    }
}