<?php

namespace Modules\Shop\Modul;

class Variationservice{
   
    public function create() {
        if(!isset($_POST["save_boot_new_variation"])){
            return [
                'job' => false,
                'result' => false,
                'id' => 0,
                'msg' => "Операция не зарущена"
            ];
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
        if(!isset($_POST["nomber_photo"])){
            return $this->error_add();
        }
        if(!isset($_GET["id_product"])){
            return $this->error_add();
        }
        
        $variation = $this->get_start_create_new();
        return $this->get_save_new_variation($variation);
    }

    
    public function get_start_create_new(){
        $is_act = 0;
        if(isset($_POST["agree"])){
            $is_act = 1;
        }
        $variation = new \Modules\Shop\Modul\Variation;
        $array_img = explode(',', $_POST["nomber_photo"]);
        $variation->set_product_id($_GET["id_product"])
            ->set_name($_POST["name"])
            ->set_price($_POST["price"])
            ->set_old_price($_POST["old_price"])
            ->set_sku($_POST["art"])
            ->set_images($array_img)
            ->set_is_active($is_act);
        return $variation;
    }

    
    public function get_save_new_variation(\Modules\Shop\Modul\Variation $variation){   
        $pdo = \Modules\Core\Modul\Sql::connect();
        try {
            
            $stmt = $pdo->prepare("
                INSERT INTO ".\Modules\Core\Modul\Env::get("DB_PREFIX")."shop_variation 
                (product_id, name, price, old_price, sku, is_active, images)
                VALUES (:product_id, :name, :price, :old_price, :sku, :is_active, :images)
            ");
            
            $params = [
                ':product_id' => $variation->get_product_id(), 
                ':name' => $variation->get_name(), 
                ':price' => $variation->get_price(), 
                ':old_price' => $variation->get_old_price(), 
                ':sku' => $variation->get_sku(), 
                ':is_active' => $variation->get_is_active_sql(), 
                ':images' => $variation->get_images_str()
            ];
            $stmt->execute($params);
            $variation->set_id($pdo->lastInsertId());   
        } catch (\PDOException $e) {
            //echo $e->getMessage();
        }

        if( $variation->get_id() >= 1){
            return [
                'job' => true,
                'result' => true,
                'id' => $variation->get_id(),
                'msg' => "Все ок"
            ];
        }else{
            return [
                'job' => true,
                'result' => false,
                'id' => 0,
                'msg' => "Ошибка вставки в бд"
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

    public function show_prod_and_variant($product_list){
        foreach($product_list as $product){
           // var_dump($product->get_id());
            $pdo = \Modules\Core\Modul\Sql::connect();
            
            $stmt2 = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_variation WHERE product_id = ?");
            $stmt2->execute([$product->get_id()]);
            while($variant_data = $stmt2->fetch(\PDO::FETCH_ASSOC)){
                $variant = new \Modules\Shop\Modul\Variation;
                $variant->set_id($variant_data["id"])
                    ->set_name($variant_data["name"])
                    ->set_price($variant_data["price"])
                    ->set_old_price($variant_data["old_price"])
                    ->set_sku($variant_data["sku"])
                    ->set_images(unserialize($variant_data["images"]))
                    ->set_is_active($variant_data["is_active"]);
               $product->add_variation($variant);
            }

        }

        return $product_list;
    }

    public function getProductVariantData($product, $variant_id){
        
        $pdo = \Modules\Core\Modul\Sql::connect();
        $stmt2 = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_variation WHERE (product_id = ? AND id=?)");        
        $stmt2->execute([$product->get_id(),$variant_id]);
        $variant_data = $stmt2->fetch(\PDO::FETCH_ASSOC);
        $variant = new \Modules\Shop\Modul\Variation;
            $variant->set_id($variant_data["id"])
                ->set_name($variant_data["name"])
                ->set_price($variant_data["price"])
                ->set_old_price($variant_data["old_price"])
                ->set_sku($variant_data["sku"])
                ->set_images(unserialize($variant_data["images"]))
                ->set_is_active($variant_data["is_active"]);
        $product->add_variation($variant);

        return $product;
    }

        public function getProductVariantDataSet($product, $variant_id){
        
        $pdo = \Modules\Core\Modul\Sql::connect();
        $stmt2 = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_variation WHERE (product_id = ? AND id=?)");        
        $stmt2->execute([$product->get_id(),$variant_id]);
        $variant_data = $stmt2->fetch(\PDO::FETCH_ASSOC);
        $variant = new \Modules\Shop\Modul\Variation;
            $variant->set_id($variant_data["id"])
                ->set_name($variant_data["name"])
                ->set_price($variant_data["price"])
                ->set_old_price($variant_data["old_price"])
                ->set_sku($variant_data["sku"])
                ->set_images(unserialize($variant_data["images"]))
                ->set_is_active($variant_data["is_active"]);
                $v =[];
                $v[] = $variant;
        $product->set_variations($v);

        return $product;
    }
    
}