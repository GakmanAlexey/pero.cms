<?php

namespace Modules\Shop\Modul;

class Catalog{
    private $id;
    private $parent_id;
    private $name;
    private $name_ru;
    private $description;
    private $is_active;
    private $create_at;
    private $updated_at;
    private $code;
    private $external_guid;
    private $url_full;
    private $url_block;
    private $img;
    private $text;
    private $sync_date;
    private $is_sync_with_1c;
    private $external_code;
    private $view_count;
    private $product_count;
    private $parent_guid;

    public function set_id($id){
        $this->id = $id;
        return $this;
    }
    public function get_id(){
        return $this->id;
    }
    

    public function set_parent_id($parent_id){
        $this->parent_id = $parent_id;
        return $this;
    }
    public function get_parent_id(){
        return $this->parent_id;
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

    public function set_description($description){
        $this->description = $description;
        return $this;
    }
    public function get_description(){
        return $this->description;
    }

    public function set_is_active($is_active){
        $this->is_active = $is_active;
        return $this;
    }
    public function get_is_active(){
        if($this->is_active) return 1;
        return 0;
    }

    public function set_create_at($create_at){
        $this->create_at = $create_at;
        return $this;
    }
    public function get_create_at(){
        return $this->create_at;
    }

    public function set_updated_at($updated_at){
        $this->updated_at = $updated_at;
        return $this;
    }
    public function get_updated_at(){
        return $this->updated_at;
    }

    public function set_code($code){
        $this->code = $code;
        return $this;
    }
    public function get_code(){
        return $this->code;
    }

    public function set_external_guid($external_guid){
        $this->external_guid = $external_guid;
        return $this;
    }
    public function get_external_guid(){
        return $this->external_guid;
    }

    public function set_url_full($url_full){
        $this->url_full = $url_full;
        return $this;
    }
    public function get_url_full(){
        return $this->url_full;
    }

    public function set_url_block($url_block){
        $this->url_block = $url_block;
        return $this;
    }
    public function get_url_block(){
        return $this->url_block;
    }

    public function set_img($img){
        $this->img = $img;
        return $this;
    }
    public function get_img(){
        return $this->img;
    }

    public function set_text($text){
        $this->text = $text;
        return $this;
    }
    public function get_text(){
        return $this->text;
    }

    public function set_sync_date($sync_date){
        $this->sync_date = $sync_date;
        return $this;
    }
    public function get_sync_date(){
        return $this->sync_date;
    }

    public function set_is_sync_with_1c($is_sync_with_1c){
        $this->is_sync_with_1c = $is_sync_with_1c;
        return $this;
    }
    public function get_is_sync_with_1c(){
        return $this->is_sync_with_1c;
    }

    public function set_external_code($external_code){
        $this->external_code = $external_code;
        return $this;
    }
    public function get_external_code(){
        return $this->external_code;
    }

    public function set_view_count($view_count){
        $this->view_count = $view_count;
        return $this;
    }
    public function get_view_count(){
        return $this->view_count;
    }

    public function set_product_count($product_count){
        $this->product_count = $product_count;
        return $this;
    }
    public function get_product_count(){
        return $this->product_count;
    }

    public function set_parent_guid($parent_guid){
        $this->parent_guid = $parent_guid;
        return $this;
    }
    public function get_parent_guid(){
        return $this->parent_guid;
    }
    
    public function ru_status(){
        if($this->is_active == 1) return "Активный";
        return "Неактивный";
    }
    
}