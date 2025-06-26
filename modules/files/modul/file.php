<?php

namespace Modules\Files\Modul;

class File{    
    private $id;
    private $name;
    private $type;
    private $size;
    private $path = NULL;
    private $extension;
    private $metadata = [];

    public function set_id($file_id){
        $this->id = $file_id;
        return $this;
    }
    public function set_name($file_name){
        $this->name = $file_name;
        return $this;
    }

    public function set_type($file_type){
        $this->type = $file_type;
        return $this;
    }

    public function set_size($file_size){
        $this->size = $file_size;
        return $this;
    }

    public function set_path($file_path){
        $this->path = $file_path;
        return $this;
    }

    public function set_extension($file_extension){
        $this->extension = $file_extension;
        return $this;
    }

    public function set_metadata($file_metadata){
        $this->metadata = $file_metadata;
        return $this;
    }

    public function add_metadata($key, $value){
        $this->metadata[$key] = $value;
        return $this;
    }

    public function get_id(){
        return $this->id;
    }

    public function get_name(){
        return $this->name;
    }
    
    public function get_type(){
        return $this->type;
    }

    public function get_size(){
        return $this->size;
    }

    public function get_path(){
        if($this->path == NULL){
            $this -> absent();
        }
        $this->path = str_replace('\\', '/', $this->path);
        $this->path = preg_replace('~(?<!:)/+~', '/', $this->path);
        return $this->path;
    }

    public function get_extension(){
        return $this->extension;
    }

    public function get_metadata(){
        return $this->metadata;
    }

    public function is_file_image(){
        return strpos($this->type, 'image/') === 0;
    }

    public function is_file_pdf(){
        return $this->type === 'application/pdf';
    }

    public function  absent(){
        $this->set_name("noimg.svg");
        $this->set_type("image/svg+xml");
        $this->set_size("11893");
        $this->set_path(DS.'modules'.DS.'files'.DS.'src'.DS.'img'.DS.'noimg.svg');
    }
}

    
