<?php

namespace Modules\News\Modul;

class Manager{ 
    public $class = "\Modules\News\Controller\Index";
    public $funct = "categor";
    public $funct_new = "news";
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

    public function create_news(\Modules\News\Modul\News $news) {
        $news->set_name(\Modules\Core\Modul\Cleanstring::sanitize($news->get_name_ru(), false, 240));
        $news->set_url_block(\Modules\Core\Modul\Url::generate($news->get_name(),"news" , "url_block"));

        $pdo = \Modules\Core\Modul\Sql::connect();
        $stmt = $pdo->prepare("SELECT full_url FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."news_categories WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $news->get_categor_id()]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC); //$result['full_url']
            
        $news->set_full_url($result['full_url'].$news->get_url_block()."/");

        if($news->get_description() == NULL){
            $news->set_description(mb_substr($news->get_text(), 0,254, 'UTF-8'));
        }

        $data = $news->to_array();

        try {
            $stmt2 = $pdo->prepare("
                INSERT INTO ".\Modules\Core\Modul\Env::get("DB_PREFIX")."news 
                (name, name_ru, url_block, full_url, main_img, list_img, 
                description, text, category_id, publish_date, edit_date, 
                author_id, is_active)
                VALUES 
                (:name, :name_ru, :url_block, :full_url, :main_img, :list_img, 
                :description, :text, :category_id, :publish_date, :edit_date, 
                :author_id, :is_active)
            ");
            
            $data['list_img'] = !empty($data['list_img']) ? serialize($data['list_img']) : null;
            
            $stmt2->execute([
                ':name' => $data['name'],
                ':name_ru' => $data['name_ru'],
                ':url_block' => $data['url_block'],
                ':full_url' => $data['full_url'],
                ':main_img' => $data['main_img'],
                ':list_img' => $data['list_img'],
                ':description' => $data['description'],
                ':text' => $data['text'],
                ':category_id' => $data['categor_id'],
                ':publish_date' => date('Y-m-d H:i:s', $data['publish_date']),
                ':edit_date' => $data['edit_date'] ? date('Y-m-d H:i:s', $data['edit_date']) : null,
                ':author_id' => $data['author']['id'],
                ':is_active' => (int)$data['is_active']
            ]);            
            $news->set_id( $pdo->lastInsertId());   
            
            } catch (\PDOException $e) {
                error_log("Ошибка сохранения новости: " . $e->getMessage());
                return false;
        }

        \Modules\Router\Modul\Manager::create($news->get_full_url(),$this->class,$this->funct_new);

        $builder = new \Modules\Router\Modul\Builder();                
        $builder->start();
        return $news;
    }

    public function pre_edit(\Modules\News\Modul\News $news){
        $pdo = \Modules\Core\Modul\Sql::connect();
        $stmt = $pdo->prepare("SELECT * FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."news WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $news->get_id()]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $list_img = unserialize($result['list_img']);
        $news->set_categor_id($result['category_id'])
            ->set_name($result['name'])
            ->set_name_ru($result['name_ru'])
            ->set_url_block($result['url_block'])
            ->set_full_url($result['full_url'])
            ->set_main_img($result['main_img'])
            ->set_list_img($list_img)
            ->set_description($result['description'])
            ->set_text($result['text']);
        return $news;
    }

    public function edit_news() {
    }

    public function delete_news() {
    }

}