<?php

namespace Modules\Shop\Modul;

class Opencatalog extends \Modules\Shop\Modul\Catalog{
    private $list_catalog = [];
    private $list_product = [];

    public function set_list_catalog($list_catalog){
        $this->list_catalog = $list_catalog;
        return $this;
    }

    public function add_to_list_catalog(\Modules\Shop\Modul\Catalog $catalog){
        $this->list_catalog[] = $catalog;
        return $this;
    }

    public function get_list_catalog(){
        return $this->list_catalog;
    }

    public function set_list_product($list_product){
        $this->list_product = $list_product;
        return $this;
    }

    public function add_to_list_product(\Modules\Shop\Modul\Product $product){
        $this->list_product[] = $product;
        return $this;
    }

    public function get_list_product(){
        return $this->list_product;
    }

    

    public function count_catalogs(){
        return count($this->list_catalog);
    }    

    public function count_product(){
        return count($this->list_product);
    }
    
}