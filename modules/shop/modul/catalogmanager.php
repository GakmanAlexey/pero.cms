<?php

namespace Modules\Shop\Modul;

class Catalogmanager{
    private $catalog;

    public function focus(\Modules\Shop\Modul\Catalog $catalog){
        $this->catalog = $catalog;
        return $this;
    }    

    public function view(){
        $viev = $this->catalog->get_view_count() + 1;
        $this->catalog->set_view_count($viev);
        return $this;
    }


    public function get_array(){
        return [
        'id' =>             $this->catalog->get_id(),
        'parent_id' =>      $this->catalog->get_parent_id(),
        'parent_guid' =>    $this->catalog->get_parent_guid(),
        'name' =>           $this->catalog->get_name(),
        'name_ru' =>        $this->catalog->get_name_ru(),
        'description' =>    $this->catalog->get_description(),
        'is_active' =>      $this->catalog->get_is_active(),
        'create_at' =>      $this->catalog->get_create_at(),
        'updated_at' =>     $this->catalog->get_updated_at(),
        'code' =>           $this->catalog->get_code(),
        'external_guid' =>  $this->catalog->get_external_guid(),
        'external_code' =>  $this->catalog->get_external_code(),
        'url_full' =>       $this->catalog->get_url_full(),
        'url_block' =>      $this->catalog->get_url_block(),
        'img' =>            $this->catalog->get_img(),
        'text' =>           $this->catalog->get_text(),
        'sync_date' =>      $this->catalog->get_sync_date(),
        'is_sync_with_1c' =>$this->catalog->get_is_sync_with_1c(),
        'view_count' =>     $this->catalog->get_view_count(),
        'product_count' =>  $this->catalog->get_product_count()
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