<?php

namespace Modules\News\Modul;

class Service{    
    public function __construct() {
        
    }

    public function create_categor($name,$description) {
        $categor = new \Modules\News\Modul\Categor;
        $categor->set_name_ru($name)
            ->set_description($description);

        $manager = new \Modules\News\Modul\Manager;
        $categor = $manager->create_categor($categor);
        return $categor;
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