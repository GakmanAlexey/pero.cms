<?php

namespace Modules\Shop\Modul;

class Productservice{
    
    public function create_new(){
        if(!isset($_POST["save_boot_new_product"])){
            return [
                'job' => false,
                'result' => false,
                'id' => 0,
                'msg' => "Операция не зарущена"
            ];
        }

        if(!isset($_POST["category"])){
            return $this->error_add();
        }
        if(!isset($_POST["name"])){
            return $this->error_add();
        }
        if(!isset($_POST["art"])){
            return $this->error_add();
        }
        if(!isset($_POST["price"])){
            return $this->error_add();
        }
        if(!isset($_POST["old_price"])){
            return $this->error_add();
        }
        if(!isset($_POST["main_photo"])){
            return $this->error_add();
        }
        if(!isset($_POST["nomber_photo"])){
            return $this->error_add();
        }

        $product = $this->get_start_create_new();
        $product = $this->set_categor_create_new($product);
        return $this->get_save_new_product($product);

    }

    public function set_categor_create_new(\Modules\Shop\Modul\Product $product){
        $categorservice = new \Modules\Shop\Modul\Catalogservice;
        $cat = $categorservice->select_item($product->get_category_id());
        $product->set_name(\Modules\Core\Modul\Cleanstring::sanitize($product->get_name_ru(), false, 240));
        if($product->get_name() == ""){            
            $chars = 'abcdefghijklmnopqrstuvwxyz';
            $rand_name = '';

            for ($i = 0; $i < 10; $i++) {
                $rand_name .= $chars[rand(0, strlen($chars) - 1)];
            }
            $product->set_name($rand_name);
        }
        $product->set_url_block(\Modules\Core\Modul\Url::generate($product->get_name(),"shop_product" , "url_block"));
        $product->set_url_full($cat->get_url_full().$product->get_url_block()."/");
        return $product;
    }
    public function get_start_create_new(){
        $is_act = 0;
        if(isset($_POST["agree"])){
            $is_act = 1;
        }
        $product = new \Modules\Shop\Modul\Product;
        $array_img = explode(',', $_POST["nomber_photo"]);
        $product->set_category_id($_POST["category"])
            ->set_name_ru($_POST["name"])
            ->set_article($_POST["art"])
            ->set_price($_POST["price"])
            ->set_old_price($_POST["old_price"])
            ->set_main_image($_POST["main_photo"])
            ->set_images($array_img)
            ->set_is_active($is_act);
        return $product;
    }

    public function get_save_new_product(\Modules\Shop\Modul\Product $product){        
        $pdo = \Modules\Core\Modul\Sql::connect();
        
        try {
            $stmt = $pdo->prepare("
                INSERT INTO ".\Modules\Core\Modul\Env::get("DB_PREFIX")."shop_product 
                (external_guid, external_code, article, name, name_ru, url_full, url_block, description, price, old_price, currency, is_active, 
                in_stock, quantity, brand_id , category_id , main_image, images, sync_date, is_sync_with_1c, sku , views_count, sales_count, barcode ,
                width, height, length, weight, created_at, updated_at, deleted_at, has_variations, attributes, tags)
                VALUES (:external_guid, :external_code, :article, :name, :name_ru, :url_full, :url_block, :description, :price, :old_price, :currency, :is_active, 
                :in_stock, :quantity, :brand_id , :category_id , :main_image, :images, :sync_date, :is_sync_with_1c, :sku , :views_count, :sales_count, :barcode ,
                :width, :height, :length, :weight, :created_at, :updated_at, :deleted_at, :has_variations, :attributes, :tags)
            ");
            
            $params = [
                ':external_guid' => $product->get_external_guid(), 
                ':external_code' => $product->get_external_code(), 
                ':article' => $product->get_article(), 
                ':name' => $product->get_name(), 
                ':name_ru' => $product->get_name_ru(), 
                ':url_full' => $product->get_url_full(), 
                ':url_block' => $product->get_url_block(), 
                ':description' => $product->get_description(), 
                ':price' => $product->get_price(), 
                ':old_price' => $product->get_old_price(), 
                ':currency' => $product->get_currency(), 
                ':is_active' => $product->get_is_active(), 
                ':in_stock' => $product->get_in_stock(), 
                ':quantity' => $product->get_quantity(), 
                ':brand_id' => $product->get_brand_id(), 
                ':category_id' => $product->get_category_id(), 
                ':main_image' => $product->get_main_image(), 
                ':images' => $product->get_images_str(), 
                ':sync_date' => $product->get_sync_date(), 
                ':is_sync_with_1c' => $product->get_is_sync_with_1c(), 
                ':sku' => $product->get_sku(), 
                ':views_count' => $product->get_views_count(), 
                ':sales_count' => $product->get_sales_count(), 
                ':barcode' => $product->get_barcode(),
                ':width' => $product->get_width(), 
                ':height' => $product->get_height(), 
                ':length' => $product->get_length(), 
                ':weight' => $product->get_weight(), 
                ':created_at' => $product->get_created_at(), 
                ':updated_at' => $product->get_updated_at(), 
                ':deleted_at' => $product->get_deleted_at(), 
                ':has_variations' => $product->get_has_variations(), 
                ':attributes' => "", 
                ':tags' => ""
            ];
            var_dump($product->get_old_price());
            foreach ($params as $key => $value) {
                $paramType = \PDO::PARAM_STR; // По умолчанию
                
                if (is_int($value)) {
                    $paramType = \PDO::PARAM_INT;
                } elseif (is_bool($value)) {
                    $paramType = \PDO::PARAM_BOOL;
                } elseif (is_null($value)) {
                    $paramType = \PDO::PARAM_NULL;
                } elseif ($key === ':old_price' || $key === ':price') {
                    $paramType = \PDO::PARAM_STR;
                }
                
                $stmt->bindValue($key, $value, $paramType);
            }
            $stmt->execute($params);
            $product->set_id($pdo->lastInsertId());        
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        if( $product->get_id() >= 1){
            return [
                'job' => true,
                'result' => true,
                'id' => $product->get_id(),
                'msg' => "Успешно сохранено"
            ];
        }else{
            return [
                'job' => true,
                'result' => false,
                'id' => 0,
                'msg' => "Ошибка"
            ];
        }
    }

    public function error_add(){
        return [
            'job' => true,
            'result' => false,
            'id' => 0,
            'msg' => "Заполните все поля"
        ];
    }
}

    