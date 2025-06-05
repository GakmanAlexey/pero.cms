<?php

namespace Modules\Shop\Modul;

class Brandmanager{
    private $brand;

    public function focus(\Modules\Shop\Modul\Brand $brand){
        $this->brand = $brand;
        return $this;
    }    

    public function view(){
        $viev = $this->brand->get_view_count() + 1;
        $this->brand->set_product_count($viev);
        return $this;
    }

    public function get_array(){
        return [
        'id' => $this->brand->get_id(),
        'name' => $this->brand->get_name(),
        'name_ru' => $this->brand->get_name_ru(),
        'description' => $this->brand->get_description(),
        'is_active' => $this->brand->get_is_active(),
        'create_at' => $this->brand->get_create_at(),
        'updated_at' => $this->brand->get_updated_at(),
        'code' => $this->brand->get_code(),
        'external_guid' => $this->brand->get_external_guid(),
        'url_full' => $this->brand->get_url_full(),
        'url_block' => $this->brand->get_url_block(),
        'img' => $this->brand->get_img(),
        'text' => $this->brand->get_text(),
        'sync_date' => $this->brand->get_sync_date(),
        'is_sync_with_1c' => $this->brand->get_is_sync_with_1c(),
        'external_code' => $this->brand->get_external_code(),
        'view_count' => $this->brand->get_view_count(),
        'product_count' => $this->brand->get_product_count()
        ];
    }

    public function select(){

    }

    public function create(){

    }

    public function update(){
        
    }

    public function delete(){
        
    }
    
}