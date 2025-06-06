<?php

namespace Modules\Seo\Modul;

class Page{
    private $id;
    private $url;
    private $title_q;
    private $description_q;
    private $keys_q;
    private $name_q;

    public function set_id($id) {
        $this->id = $id;  
        return $this;      
    }
    public function get_id() {
        return $this->id;        
    }

    public function set_url($url) {
        $this->url = $url;  
        return $this;      
    }
    public function get_url() {
        return $this->url;        
    }

    public function set_title($title_q) {
        $this->title_q = $title_q;  
        return $this;      
    }
    public function get_title() {
        return $this->title_q;        
    }

    public function set_description($description_q) {
        $this->description_q = $description_q;  
        return $this;      
    }
    public function get_description() {
        return $this->description_q;        
    }

    public function set_keys($keys_q) {
        $this->keys_q = $keys_q;  
        return $this;      
    }
    public function get_keys() {
        return $this->keys_q;        
    }

    public function set_name($name_q) {
        $this->name_q = $name_q;  
        return $this;      
    }
    public function get_name() {
        return $this->name_q;        
    }

    
}

    
