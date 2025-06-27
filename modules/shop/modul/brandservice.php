<?php

namespace Modules\Shop\Modul;

class Brandservice{
    public $brand_array = [];
    public function show_all(){
        $pdo = \Modules\Core\Modul\Sql::connect(); 
        $stmt2 = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_brand");
        $stmt2->execute([]);
        while($brand_data = $stmt2->fetch(\PDO::FETCH_ASSOC)){
            $brand = new  \Modules\Shop\Modul\Brand();
            $brand->set_id($brand_data["id"])
                ->set_name($brand_data["name"])
                ->set_name_ru($brand_data["name_ru"])
                ->set_description($brand_data["description"])
                ->set_is_active($brand_data["is_active"])
                ->set_create_at($brand_data["created_at"])
                ->set_updated_at($brand_data["updated_at"])
                ->set_code($brand_data["code"])
                ->set_external_guid($brand_data["external_guid"])
                ->set_url_full($brand_data["url_full"])
                ->set_url_block($brand_data["url_block"])
                ->set_img($brand_data["img"])
                ->set_text($brand_data["text"])
                ->set_sync_date($brand_data["sync_date"])
                ->set_is_sync_with_1c($brand_data["is_sync_with_1c"])
                ->set_external_code($brand_data["external_code"])
                ->set_view_count($brand_data["view_count"])
                ->set_product_count($brand_data["product_count"]);
            $this->brand_array[] = $brand;
        }
        
        return  $this->brand_array;
    }

    public function create_new(){
        if(!isset($_POST["save_boot_new_brand"])){
            return [
                'job' => false,
                'status' => false,
                'id' => 0,
                'msg' => 'Не заполнены все данные'
            ];
        }
        if(!isset($_POST["name"])){
            return [
                'job' => true,
                'status' => false,
                'id' => 0,
                'msg' => 'Не заполнены все данные'
            ];
        }
        if(!isset($_POST["nomber_photo"])){
            return [
                'job' => true,
                'status' => false,
                'id' => 0,
                'msg' => 'Не заполнены все данные'
            ];
        }
        if(!isset($_POST["mini_discription"])){
            return [
                'job' => true,
                'status' => false,
                'id' => 0,
                'msg' => 'Не заполнены все данные'
            ];
        }
        if(!isset($_POST["discription"])){
            return [
                'job' => true,
                'status' => false,
                'id' => 0,
                'msg' => 'Не заполнены все данные'
            ];
        }
        $brand = new  \Modules\Shop\Modul\Brand();
        $brand->set_name_ru($_POST["name"])
            ->set_description($_POST["mini_discription"])
            ->set_is_active(1)
            ->set_img($_POST["nomber_photo"])
            ->set_text($_POST["discription"]);

        $manager = new \Modules\Shop\Modul\Brandmanager;
        return $manager->create($brand);
    }
    
}