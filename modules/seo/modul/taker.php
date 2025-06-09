<?php

namespace Modules\Seo\Modul;

class Taker{


    public function show_all(){
        $page_list = [];
        $pdo = \Modules\Core\Modul\Sql::connect();
        $stmt = $pdo->prepare('SELECT * FROM '.\Modules\Core\Modul\Env::get("DB_PREFIX") .'heads ');
        $stmt->execute([]);
        while($result = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $page = new \Modules\Seo\Modul\Page;
                $page->set_id($result["id"])
                    ->set_url($result["url"])
                    ->set_title($result["title_q"])
                    ->set_description($result["description_q"])
                    ->set_keys($result["keys_q"])
                    ->set_name($result["name_q"]);
            $page_list[] = $page;
        }

        return $page_list;
    }

    public function show_item(){
        $page = new \Modules\Seo\Modul\Page;
        if(!(isset($_GET["id"]) and ($_GET["id"] >= 1))) return $page ;

        $pdo = \Modules\Core\Modul\Sql::connect();
        $stmt = $pdo->prepare('SELECT * FROM '.\Modules\Core\Modul\Env::get("DB_PREFIX") .'heads WHERE id=? LIMIT 1');
        $stmt->execute([$_GET["id"]]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $page->set_id($result["id"])
                    ->set_url($result["url"])
                    ->set_title($result["title_q"])
                    ->set_description($result["description_q"])
                    ->set_keys($result["keys_q"])
                    ->set_name($result["name_q"]);
        return $page ;
    }
    
}

    
