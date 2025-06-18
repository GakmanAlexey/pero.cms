<?php

namespace Modules\Shop\Modul;

class Catalogservice{
    private $main_url = "catalog";
    
    public function add_father(){
        $categor = new \Modules\Shop\Modul\Catalog;
        $categor ->set_id(0)
            ->set_parent_id(-1)
            ->set_name("main")
            ->set_name_ru("Корневая категория");

        return $categor;
    }

    public function list_select_all(){
        $array_cat = [];
        $array_cat[] = $this->add_father();
        $pdo = \Modules\Core\Modul\Sql::connect(); 
        $stmt2 = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_catalog");
        $stmt2->execute([]);
        while($categor_data = $stmt2->fetch(\PDO::FETCH_ASSOC)){
            $categor = new  \Modules\Shop\Modul\Catalog();
            $categor->set_id($categor_data["id"])
                ->set_parent_id($categor_data["id"])
                ->set_name($categor_data["id"])
                ->set_name_ru($categor_data["id"])
                ->set_description($categor_data["id"])
                ->set_is_active($categor_data["id"])
                ->set_create_at($categor_data["id"])
                ->set_updated_at($categor_data["id"])
                ->set_code($categor_data["id"])
                ->set_external_guid($categor_data["id"])
                ->set_url_full($categor_data["id"])
                ->set_url_block($categor_data["id"])
                ->set_img($categor_data["id"])
                ->set_text($categor_data["id"])
                ->set_sync_date($categor_data["id"])
                ->set_is_sync_with_1c($categor_data["id"])
                ->set_external_code($categor_data["id"])
                ->set_view_count($categor_data["id"])
                ->set_product_count($categor_data["id"])
                ->set_parent_guid($categor_data["id"]);
            $array_cat[] = $categor;
        }
        return $array_cat;       
    }

    public function save_new(){
        if(!isset($_POST["save_boot_new_cat"])) return ["status" => false, "job" => false];

        if(((!isset($_POST["category"])) or (!isset($_POST["nomber_photo"]))) or ((!isset($_POST["discription"])))){
            return [
                "status" => false,
                "msg" => "Заполните все поля", 
                "job" => true
            ];
        }

        $categor = new  \Modules\Shop\Modul\Catalog();
        if($_POST["agree"] == "on"){
            $agree = true;
        }else{
            $agree = false;
        }
        $categor->set_parent_id($_POST["category"]);
    }
    
    
}