<?php

namespace Modules\Admin\Modul;

Class Service{
    private $img;
    private $name;
    private $description;
    private $buttons = [];

    public function set_img($img){
        $this->img = $img;
        return $this;
    }
    public function get_img(){        
        return $this->img;
    }

    public function set_name($name) {
        $this->name = $name;
        return $this;
    }    
    public function get_name() {
        return $this->name;
    }

    public function set_description($description) {
        $this->description = $description;
        return $this;
    }    
    public function get_description() {
        return $this->description;
    }
    
    public function set_buttons(array $buttons) {
        $this->buttons = $buttons;
        return $this;
    }    
    public function get_buttons() {
        return $this->buttons;
    }    
    public function add_button($button) {
        $this->buttons[] = $button;
        return $this;
    }
}
