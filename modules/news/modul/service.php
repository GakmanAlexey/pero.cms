<?php

namespace Modules\News\Modul;

class Service{    
    public function __construct() {
        
    }

    public function create_categor($name,$url,$description) {
        $categor = new \Modules\News\Modul\Categor;
        $categor->set_name($name)
            ->set_url_block($url)
            ->set_description($description);
    }
    
    public function edit_categor() {
    }

    public function delete_categor() {
    }

    public function create_news() {
    }

    public function edit_news() {
    }

    public function delete_news() {
    }

}