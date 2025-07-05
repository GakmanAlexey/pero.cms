<?php

namespace Modules\Shop\Modul;

class Specific{
    private $product_id = 0;
    private $variant_id = 0;
    private $specific = [];

   

    public function set_product_id($product_id){
        $this->product_id = $product_id;
        return $this;
    }
    public function get_product_id(){
        return $this->product_id;
    }

    public function set_variant_id($variant_id){
        $this->variant_id = $variant_id;
        return $this;
    }
    public function get_variant_id(){
        return $this->variant_id;
    }

    public function set_specific($specific){
        $this->specific = $specific;
        return $this;
    }
    public function get_specific(){
        return $this->specific;
    }

    public function add_specific_arr($specific_one){
        $this->specific[] = $specific_one;
        return $this;
    }

    public function add_specific_item($id_list,$id_data,$name,$name_ru,$value,$unit,$is_filter,$is_visible){
        $array = [$id_list,$id_data,$name,$name_ru,$value,$unit,$is_filter,$is_visible];
        $this->specific[] = $array;
        return $this;
    }

    
    
}