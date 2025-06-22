<?php

namespace Modules\Shop\Modul;

class Catalogservice{
    private $main_url = "catalog";
    
    public function add_father(){
        $categor = new \Modules\Shop\Modul\Catalog;
        $categor ->set_id(0)
            ->set_parent_id(-1)
            ->set_name("main")
            ->set_name_ru("Корневая категория")
            ->set_url_full($this->main_url)
            ->set_url_block($this->main_url);

        return $categor;
    }
    public function show_list(){
        $array_cat = [];
        $pdo = \Modules\Core\Modul\Sql::connect(); 
        $stmt2 = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_catalog");
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
        return $array_cat;       
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
        return $array_cat;       
    }

    public function save_new(){
        if(!isset($_POST["save_boot_new_cat"])) return ["status" => false, "job" => false];

        if(!isset($_POST["category"])){ return ["status" => false, "msg" => "Заполните поле категории", "job" => true]; }
        if(!isset($_POST["nomber_photo"])){ return ["status" => false, "msg" => "Заполните поле категории", "job" => true]; }
        if(!isset($_POST["name"])){ return ["status" => false, "msg" => "Заполните поле категории", "job" => true]; }
        if(!isset($_POST["text"])){ return ["status" => false, "msg" => "Заполните поле категории", "job" => true]; }
        if(!isset($_POST["discription"])){ return ["status" => false, "msg" => "Заполните поле категории", "job" => true]; }

        $categor = new  \Modules\Shop\Modul\Catalog();
        if(isset($_POST["agree"]) AND $_POST["agree"] == "on"){$agree = true;}else{$agree = false;}
        $categor->set_parent_id($_POST["category"])
            ->set_img($_POST["nomber_photo"])
            ->set_name_ru($_POST["name"])
            ->set_text($_POST["text"])
            ->set_description($_POST["discription"])
            ->set_is_active($agree);

        $categor = $this->init_save($categor);
        
        if($categor->get_id() >= 1){
            $router = new \Modules\Router\Modul\Manager;
            $router->create($categor->get_url_full(),"\Modules\Shop\Controller\Catalog","open");
            //todo  добавить в роутер и хеадер

            $page = new \Modules\Seo\Modul\Page;
            $page->set_url($categor->get_url_full())
                -> set_title("Каталог")
                -> set_description("Описание каталога")
                -> set_name("Категория")
                -> set_keys("ключ");

            $builder = new \Modules\Router\Modul\Builder();                
        $builder->start();
            return ["status" => true, "msg" => "Создание прошло успешно", "job" => true, "id" => $categor->get_id()];
        }else{
            return ["status" => false, "msg" => "Сбой создания", "job" => true];
        }

        

    }
    
    public function init_save(\Modules\Shop\Modul\Catalog $categor){
        $father_categor = $this->select_item($categor->get_parent_id());
        $categor->set_name(\Modules\Core\Modul\Cleanstring::sanitize($categor->get_name_ru(), false, 240));
        $categor->set_url_block(\Modules\Core\Modul\Url::generate($categor->get_name(),"shop_catalog" , "url_block"));
        $categor->set_url_full("/".$this->main_url."/".$categor->get_url_block()."/");

        $chars = 'abcdefghijklmnopqrstuvwxyz';
        $external_guid = '';

        for ($i = 0; $i < 35; $i++) {
            $external_guid .= $chars[rand(0, strlen($chars) - 1)];
        }        
        $categor->set_external_guid($external_guid);
        $categor->set_code($external_guid);

        $pdo = \Modules\Core\Modul\Sql::connect();

        try {
            $parentId = $categor->get_parent_id();
            if ($parentId == 0) {
                $parentId = null; // Устанавливаем NULL для корневой категории
            }

            $stmt = $pdo->prepare("
                INSERT INTO ".\Modules\Core\Modul\Env::get("DB_PREFIX")."shop_catalog 
                (parent_id, parent_guid, name, name_ru, description, is_active, code, 
                external_guid, external_code, url_full, url_block, img, text, 
                sync_date, is_sync_with_1c, view_count, product_count, create_at)
                VALUES (:parent_id, :parent_guid, :name, :name_ru, :description, :is_active, :code, 
                        :external_guid, :external_code, :url_full, :url_block, :img, :text, 
                        :sync_date, :is_sync_with_1c, :view_count, :product_count, NOW())
            ");
            
            $params = [
                ':parent_id' => $parentId, // NULL или существующий ID
                ':parent_guid' => $categor->get_parent_guid() ?: '',
                ':name' => $categor->get_name() ?: 'Без названия',
                ':name_ru' => $categor->get_name_ru() ?: '',
                ':description' => $categor->get_description() ?: '',
                ':is_active' => $categor->get_is_active() ,
                ':code' => $categor->get_code() ?: '',
                ':external_guid' => substr($categor->get_external_guid(), 0, 36),
                ':external_code' => $categor->get_external_code() ?: '',
                ':url_full' => $categor->get_url_full(),
                ':url_block' => $categor->get_url_block() ?: '',
                ':img' => $categor->get_img() ?: '',
                ':text' => $categor->get_text() ?: '',
                ':sync_date' => $categor->get_sync_date() ?: date('Y-m-d H:i:s'),
                ':is_sync_with_1c' => $categor->get_is_sync_with_1c() ,
                ':view_count' => $categor->get_view_count() ?: 0,
                ':product_count' => $categor->get_product_count() ?: 0
            ];
            
            $stmt->execute($params);
            $categor->set_id($pdo->lastInsertId());
        } catch (\PDOException $e) {
           
        }

        return  $categor;
    }
    
    public function select_item($id){
        $categor = new \Modules\Shop\Modul\Catalog;
        $categor->set_id($id);
        if($categor->get_id() >= 1){
            $categor = $this->select_item_data($categor);
        }else{
            $categor = $this->add_father();
        }

        return $categor;
        
    }
    public function select_item_data(\Modules\Shop\Modul\Catalog $categor){
        $pdo = \Modules\Core\Modul\Sql::connect(); 
        $stmt2 = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_catalog WHERE id=?");
        $stmt2->execute([$categor->get_id()]);
        $categor_data = $stmt2->fetch(\PDO::FETCH_ASSOC);        
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

        return $categor;
    }
}