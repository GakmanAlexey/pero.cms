<?php

namespace Modules\News\Modul;

class Manager{ 
    public $class = "\Modules\News\Controller\Index";
    public $funct = "categor";
    public function __construct() {
        
    }

    public function create_categor(\Modules\News\Modul\Categor $categor) {
        $categor->set_name(\Modules\Core\Modul\Cleanstring::sanitize($categor->get_name_ru(), false, 240));
        $categor->set_url_block(\Modules\Core\Modul\Url::generate($categor->get_name(),"news_categories" , "url_block"));
        $categor->set_full_url($categor->main_dir.$categor->get_url_block()."/");
        $data = $categor->to_array();

        $pdo = \Modules\Core\Modul\Sql::connect();
        $stmt = $pdo->prepare("
            INSERT INTO ".\Modules\Core\Modul\Env::get("DB_PREFIX")."news_categories 
            (name, name_ru, url_block, full_url, main_img, list_img, description)
            VALUES (:name, :name_ru, :url_block, :full_url, :main_img, :list_img, :description)
        ");
        $data['list_img'] = serialize($data['list_img']);
        $stmt->execute([
            ':name' => $data['name'],
            ':name_ru' => $data['name_ru'],
            ':url_block' => $data['url_block'],
            ':full_url' => $data['full_url'],
            ':main_img' => $data['main_img'],
            ':list_img' => $data['list_img'],
            ':description' => $data['description']
        ]);
        $categor->set_id($pdo->lastInsertId());

        \Modules\Router\Modul\Manager::create($categor->get_full_url(),$this->class,$this->funct);

        $builder = new \Modules\Router\Modul\Builder();                
        $builder->start();
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