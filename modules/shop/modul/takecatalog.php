<?php

namespace Modules\Shop\Modul;

class Takecatalog{
    
    public function take_categor_main(){
        $data = \Modules\Router\Modul\Router::$url["d_line"];
        $array_cat = [];
        $pdo = \Modules\Core\Modul\Sql::connect(); 
        $stmt2 = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_catalog WHERE parent_id IS NULL AND is_active  = 1");
        $stmt2->execute([]);
        while($categor_data = $stmt2->fetch(\PDO::FETCH_ASSOC)){
            $categor = new  \Modules\Shop\Modul\Catalog();
            $categor->set_id($categor_data["id"])
                ->set_parent_id($categor_data["parent_id"])
                ->set_name($categor_data["name"])
                ->set_name_ru($categor_data["name_ru"])
                ->set_description($categor_data["description"])
                ->set_is_active($categor_data["is_active"])
                ->set_create_at($categor_data["create_at"])
                ->set_updated_at($categor_data["updated_at"])
                ->set_code($categor_data["code"])
                ->set_external_guid($categor_data["external_guid"])
                ->set_url_full($categor_data["url_full"])
                ->set_url_block($categor_data["url_block"])
                ->set_img($categor_data["img"])
                ->set_text($categor_data["text"])
                ->set_sync_date($categor_data["sync_date"])
                ->set_is_sync_with_1c($categor_data["is_sync_with_1c"])
                ->set_external_code($categor_data["external_code"])
                ->set_view_count($categor_data["view_count"])
                ->set_product_count($categor_data["product_count"])
                ->set_parent_guid($categor_data["parent_guid"]);
            $array_cat[] = $categor;
        }
        return  $array_cat;
    }
}