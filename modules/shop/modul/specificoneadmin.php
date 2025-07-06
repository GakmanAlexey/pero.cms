<?php

namespace Modules\Shop\Modul;

class Specificoneadmin extends Specificone{
    private $active;
    private $value_data;

   

    public function set_active($active){
        $this->active = $active;
        return $this;
    }
    public function get_active(){
        return $this->active;
    }

    public function set_value_data($value_data){
        $this->value_data = $value_data;
        return $this;
    }
    public function get_value_data(){
        return $this->value_data;
    }
    

    
    
}