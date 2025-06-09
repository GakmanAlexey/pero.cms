<?php

namespace Modules\Seo\Modul;

class Manager{


    public function save(){
        if(isset($_POST["save_boot_seo"]) and $_POST["save_boot_seo"] =="save"){
            $page = new \Modules\Seo\Modul\Page;
            $page->set_id($_GET["id"]);
            $page->set_url($_POST["Url"]);
            $page->set_title($_POST["title"]);
            $page->set_description($_POST["discription"]);
            $page->set_keys($_POST["key"]);
            $page->set_name($_POST["name"]);
            $service = new \Modules\Seo\Modul\Service();
            $res = ["status" => $service->target($page)->update()];
            return $res;
        }
        return [];
    }
    
}

    
