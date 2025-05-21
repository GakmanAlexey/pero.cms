<?php

namespace Modules\Group\Modul;

class Group{
    private $id;
    private $name;
    private $name_ru;
    private $description;
    private $is_default;
    private $user_list;
    private $prefix;


    public function set_id($id){
        $this->id = $id;
        return $this; 
    } 
    public function set_name($name){
        $this->name = $name;
        return $this; 
    } 
    public function set_name_ru($name_ru){
        $this->name_ru = $name_ru;
        return $this; 
    } 
    public function set_description($description){
        $this->description = $description;
        return $this; 
    } 
    public function set_is_default($is_default){
        $this->is_default = $is_default;
        return $this; 
    } 
    public function set_user_list($user_list){
        $this->user_list = $user_list;
        return $this; 
    } 
    public function set_prefix($prefix){
        $this->prefix = $prefix;
        return $this; 
    }  


    public function get_id(){
        return $this->id;
    }
    public function get_name(){
        return $this->name;
    }
    public function get_name_ru(){
        return $this->name_ru;
    }
    public function get_description(){
        return $this->description;
    }
    public function get_is_default(){
        return $this->is_default;
    }
    public function get_user_list(){
        return $this->user_list;
    }
    public function get_prefix(){
        return $this->prefix;
    }

    public function is_validate(){
        if(empty($this->name)) return false;
        if(empty($this->name_ru)) return false;
        if(empty($this->prefix)) return false;
        return true;
    }

}

    
