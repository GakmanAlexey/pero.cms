<?php

namespace Modules\User\Modul;

class User{
    private $id;
    private $username;
    private $email;
    private $password_hash;
    private $password;
    private $password2;
    private $token;
    private $is_active;
    private $is_ban;
    private $reason_ban;
    private $expiry_ban;

    public function set_ban($is_ban = true, $reason_ban = "Без коментария", $expiry_ban = 30000000){
        $this->is_ban = $is_ban;
        $this->reason_ban = $reason_ban;
        $this->expiry_ban = $expiry_ban;
        return $this; 
    } 
    public function un_ban(){
        $this->is_ban = false;
        $this->reason_ban = "";
        $this->expiry_ban = 0;
        return $this; 
    } 

    public function set_password2($password2){
        $this->password2 = $password2;
        return $this; 
    } 
    public function set_token($token){
        $this->token = $token;
        return $this; 
    } 

    public function set_id($id){
        $this->id = $id;
        return $this; 
    }
    public function set_username($username){
        $this->username = $username;
        return $this; 
    }

    public function set_email($email){
        $this->email = $email;
        return $this; 
    }    

    public function set_password_hash($password_hash){
        $this->password_hash = $password_hash;
        return $this; 
    }  

    public function set_password($password){
        $this->password = $password;
        return $this; 
    } 

    public function set_is_active(bool $is_active){
        $this->is_active = $is_active;
        return $this; 
    }

    public function activate(){
        $this->is_active = true;
        return $this;
    }

    public function deactivate(){
        $this->is_active = false;
        return $this;
    }


    public function get_ban(){
        return $this->is_ban; 
    } 
    public function get_ban_reason(){
        return [
            'status_ban' => $this->is_ban,
            'reason_ban' => $this->reason_ban,
            'expiry_ban' => $this->expiry_ban
        ];
    } 
    public function get_id(){
        return $this->id;
    }
    public function get_username(){
        return $this->username;
    }
    public function get_password(){
        return $this->password;
    }
    public function get_password2(){
        return $this->password2;
    }

    public function get_email(){
        return $this->email;
    }    

    public function get_password_hash(){
        return $this->password_hash;
    } 

    public function get_active(){
        return (int)$this->is_active;
    }

    public function get_token(){
        return $this->token;
    }

}

    
