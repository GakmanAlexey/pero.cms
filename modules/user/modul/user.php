<?php

namespace Modules\User\Modul;

class User{
    private $id;
    private $username;
    private $email;
    private $password_hash;
    private $password;
    private $is_active;

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


    public function get_id(){
        return $this->id;
    }
    public function get_username(){
        return $this->username;
    }
    public function get_password(){
        return $this->password;
    }

    public function get_email(){
        return $this->email;
    }    

    public function get_password_hash(){
        return $this->password_hash;
    } 

    public function get_active(){
        return $this->is_active;
    }

}

    
