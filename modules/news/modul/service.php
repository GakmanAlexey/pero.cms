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

    public function create_news($name_ru, $text, $is_active, $category_id, $user_id) {
        $user = new \Modules\User\Modul\User();
        $user->set_id($user_id);
        $news = new \Modules\News\Modul\News;
        $news->set_name_ru($name_ru)
            ->set_text($text)
            ->set_active($is_active)
            ->set_author($user)
            ->set_categor_id($category_id)
            ->set_publish_date(time());
        $manager = new \Modules\News\Modul\Manager;
        $news = $manager->create_news($news);
    }

    public function edit_news($news_id) {
        $news = new \Modules\News\Modul\News;
        $news->set_id($news_id);
        $manager = new \Modules\News\Modul\Manager;
        $news = $manager->pre_edit($news);
    }

    public function delete_news() {
    }

}