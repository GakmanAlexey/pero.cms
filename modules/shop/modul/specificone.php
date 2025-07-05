<?php

namespace Modules\Shop\Modul;

class Specificone{
    private $id;
    private $name;
    private $name_ru;
    private $unit;
    private $is_filter;
    private $is_visible;

   

    public function set_id($id){
        $this->id = $id;
        return $this;
    }
    public function get_id(){
        return $this->id;
    }
    
    public function set_name($name){
        $this->name = $name;
        return $this;
    }
    public function get_name(){
        return $this->name;
    }
    
    public function set_name_ru($name_ru){
        $this->name_ru = $name_ru;
        return $this;
    }
    public function get_name_ru(){
        return $this->name_ru;
    }
    
    public function set_unit($unit){
        $this->unit = $unit;
        return $this;
    }
    public function get_unit(){
        return $this->unit;
    }

    
    public function set_is_filter(bool $is_filter){
        $this->is_filter = $is_filter;
        return $this;
    }
    public function get_is_filter(){
        return $this->is_filter;
    }
    public function set_sql_is_filter($is_filter){
        if($is_filter = 1){
            $this->is_filter = true;
            return $this;
        };
        $this->is_filter = false;
        return $this;
    }
    public function get_sql_is_filter(){
        if($this->is_filter) return 1;
        return 0;
    }
    
    
    public function set_is_visible(bool $is_visible){
        $this->is_visible = $is_visible;
        return $this;
    }
    public function get_is_visible(){
        return $this->is_visible;
    }
    public function set_sql_is_visible($is_visible){
        if($is_visible = 1){
            $this->is_visible = true;
            return $this;
        };
        $this->is_visible = false;
        return $this;
    }
    public function get_sql_is_visible(){
        if($this->is_visible) return 1;
        return 0;
    }

    
    
}