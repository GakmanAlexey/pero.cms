<?php

namespace Modules\News\Modul;

class Taker{    
    public function __construct() {
        
    }

    public function get_all_categor() {
        $cat_arr = [];
        $pdo = \Modules\Core\Modul\Sql::connect();
        $stmt = $pdo->prepare("SELECT * FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."news_categories");
        $stmt->execute([]);
        $x = 0;
        while($result = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $list_img = unserialize($result['list_img']);

            $cat_arr[$x] =  new \Modules\News\Modul\Categor;
            $cat_arr[$x]->set_id($result["id"])
                ->set_name($result["name"])
                ->set_name_ru($result["name_ru"])
                ->set_url_block($result["url_block"])
                ->set_full_url($result["full_url"])
                ->set_main_img($result["main_img"])
                ->set_list_img($list_img)
                ->set_description($result["description"]);
            $x++;
        }
        return $cat_arr;
    }
    
    public function get_list_news(){
        $url = \Modules\Router\Modul\Router::$url;
        $pdo = \Modules\Core\Modul\Sql::connect();
        $stmt = $pdo->prepare("SELECT * FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."news_categories WHERE full_url = ? LIMIT 1");
        $stmt->execute([$url["d_line"]]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if(!$result){
            $stmt = $pdo->prepare("SELECT * FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."news_categories LIMIT 1");
            $stmt->execute([]);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        $list_img = unserialize($result['list_img']);
        $focus_categor =  new \Modules\News\Modul\Categor;
        $focus_categor->set_id($result["id"])
                ->set_name($result["name"])
                ->set_name_ru($result["name_ru"])
                ->set_url_block($result["url_block"])
                ->set_full_url($result["full_url"])
                ->set_main_img($result["main_img"])
                ->set_list_img($list_img)
                ->set_description($result["description"]);

        $stmt2 = $pdo->prepare("SELECT * FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."news WHERE category_id = ? and is_active = ?");
        $stmt2->execute([$focus_categor->get_id(), 1]);
        $user = new \Modules\User\Modul\User;
        $count_news = 0;
        while($result2 = $stmt2->fetch(\PDO::FETCH_ASSOC)){
            $user->set_id($result2["author_id"]);
            $list_img = unserialize($result2['list_img']);
            $news_arr[$count_news] =  new \Modules\News\Modul\News;
            $news_arr[$count_news]->set_id($result2["id"])
                ->set_categor_id($focus_categor->get_id())
                ->set_name($result2["name"])
                ->set_name_ru($result2["name_ru"])
                ->set_url_block($result2["url_block"])
                ->set_full_url($result2["full_url"])
                ->set_main_img($result2["main_img"])
                ->set_list_img($list_img)
                ->set_description($result2["description"])
                ->set_text($result2["text"])
                ->set_publish_date($result2["publish_date"])
                ->set_author($user);
            $count_news++;
        }
        return $news_arr;
    }

    public function get_news(){
        $pdo = \Modules\Core\Modul\Sql::connect();
        $main_news =  new \Modules\News\Modul\News;
        $url = \Modules\Router\Modul\Router::$url;

        $stmt1 = $pdo->prepare("SELECT * FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."news WHERE full_url = ? and is_active = ? LIMIT 1");
        $stmt1->execute([$url["d_line"], 1]);
        $result2 = $stmt1->fetch(\PDO::FETCH_ASSOC);
        if(!$result2){
            return $main_news;
        }
        $take_user =new \Modules\User\Modul\Taker;
        $user =  $take_user->get_from_id($result2["author_id"]);
        $user->set_id($result2["author_id"]);
        $list_img = unserialize($result2['list_img']);
            $main_news->set_id($result2["id"])
                ->set_categor_id($result2["category_id"])
                ->set_name($result2["name"])
                ->set_name_ru($result2["name_ru"])
                ->set_url_block($result2["url_block"])
                ->set_full_url($result2["full_url"])
                ->set_main_img($result2["main_img"])
                ->set_list_img($list_img)
                ->set_description($result2["description"])
                ->set_text($result2["text"])
                ->set_publish_date($result2["publish_date"])
                ->set_author($user);
        return $main_news;
    }
    
    public function get_2news_in_category($id_cat, $non_this_cat){
        $pdo = \Modules\Core\Modul\Sql::connect();
        $stmt2 = $pdo->prepare("SELECT * FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."news WHERE (category_id = ? and is_active = ?) and id != ? ORDER BY id DESC LIMIT 2");
        $stmt2->execute([$id_cat, 1,$non_this_cat]);
        $user = new \Modules\User\Modul\User;
        $count_news = 0;
        while($result2 = $stmt2->fetch(\PDO::FETCH_ASSOC)){
            $user->set_id($result2["author_id"]);
            $list_img = unserialize($result2['list_img']);
            $news_arr[$count_news] =  new \Modules\News\Modul\News;
            $news_arr[$count_news]->set_id($result2["id"])
                ->set_categor_id($result2["category_id"])
                ->set_name($result2["name"])
                ->set_name_ru($result2["name_ru"])
                ->set_url_block($result2["url_block"])
                ->set_full_url($result2["full_url"])
                ->set_main_img($result2["main_img"])
                ->set_list_img($list_img)
                ->set_description($result2["description"])
                ->set_text($result2["text"])
                ->set_publish_date($result2["publish_date"])
                ->set_author($user);
            $count_news++;
        }
        return $news_arr;
    }

    public function get_carusel($count){
        $pdo = \Modules\Core\Modul\Sql::connect();
        $stmt2 = $pdo->prepare("SELECT * FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."news WHERE  is_active = ? ORDER BY id DESC LIMIT ?");
        $stmt2->execute([1,$count]);
        $user = new \Modules\User\Modul\User;
        $count_news = 0;
        while($result2 = $stmt2->fetch(\PDO::FETCH_ASSOC)){
            $user->set_id($result2["author_id"]);
            $list_img = unserialize($result2['list_img']);
            $news_arr[$count_news] =  new \Modules\News\Modul\News;
            $news_arr[$count_news]->set_id($result2["id"])
                ->set_categor_id($result2["category_id"])
                ->set_name($result2["name"])
                ->set_name_ru($result2["name_ru"])
                ->set_url_block($result2["url_block"])
                ->set_full_url($result2["full_url"])
                ->set_main_img($result2["main_img"])
                ->set_list_img($list_img)
                ->set_description($result2["description"])
                ->set_text($result2["text"])
                ->set_publish_date($result2["publish_date"])
                ->set_author($user);
            $count_news++;
        }
        return $news_arr;

    }

}