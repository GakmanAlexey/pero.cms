<?php

namespace Modules\News\Modul;

class Categor{
    private $id;
    private $name;
    private $name_ru;
    private $url_block;
    private $full_url;
    private $main_img;
    private $list_img = [];
    private $description;

    public $main_dir = "/";
    
    public function __construct() {
        
    }

    public function set_id($id) {
        $this->id = $id;
        return $this;
    }

    public function set_name($name) {
        $this->name = $name;
        return $this;
    }

    public function set_name_ru($name_ru) {
        $this->name_ru = $name_ru;
        return $this;
    }

    public function set_url_block($url_block) {
        $this->url_block = $url_block;
        return $this;
    }

    public function set_full_url($full_url) {
        $this->full_url = $full_url;
        return $this;
    }

    public function set_main_img($main_img) {
        $this->main_img = $main_img;
        return $this;
    }

    public function set_list_img($list_img) {
        $this->list_img = $list_img;
        return $this;
    }

    public function set_description($description) {
        $this->description = $description;
        return $this;
    }

    public function add_to_list_img($img) {
        $this->list_img[] = $img;
        return $this;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_name() {
        return $this->name;
    }

    public function get_name_ru() {
        return $this->name_ru;
    }

    public function get_url_block() {
        return $this->url_block;
    }

    public function get_full_url() {
        return $this->full_url;
    }

    public function get_main_img() {
        return $this->main_img;
    }

    public function get_list_img() {
        return $this->list_img;
    }

    public function get_description() {
        return $this->description;
    }
    
    public function to_array(){
        return [
            'id' => $this->id,
            'name' => $this->name,
            'name_ru' => $this->name_ru,
            'url_block' => $this->url_block,
            'full_url' => $this->full_url,
            'main_img' => $this->main_img,
            'list_img' => $this->list_img,
            'description' => $this->description
        ];
    }
    
}