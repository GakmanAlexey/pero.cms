<?php

namespace Modules\Shop\Modul;

class Specificservice{
   
    public function show_all(){
        $specific_list = [];

        $pdo = \Modules\Core\Modul\Sql::connect(); 
        $stmt = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_specific_list");
        $stmt->execute([]);
        
        while($specific_data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $specific = new \Modules\Shop\Modul\Specificoneadmin();
            $specific->set_id($specific_data["id"])
                ->set_name($specific_data["name"])
                ->set_name_ru($specific_data["name_ru"])
                ->set_unit($specific_data["unit"])
                ->set_sql_is_filter($specific_data["is_filter"])
                ->set_sql_is_visible($specific_data["is_visible"])
                ->set_active('noactive');
            
            $specific_list[] = $specific;
        }
        
        return $specific_list;
    }

    public function show_data_product_id($id_product){
        $spec = new \Modules\Shop\Modul\Specific;
        $spec->set_product_id($id_product);
        $spec->set_variant_id(0);
        $pdo = \Modules\Core\Modul\Sql::connect(); 
        $stmt = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_specific_data WHERE (product_id = ?) and (varianr_id = 0)");
        $stmt->execute([$spec->get_product_id()]);
        $prod_data = [];
        while($product_specific_data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $prod_data[] = [$product_specific_data["specific_id"],$product_specific_data["value"],$product_specific_data["id"]];
        }
        foreach( $prod_data as  $prod_data_item) {
            $stmt2 =  $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_specific_list WHERE id = ? LIMIT 1");
            $stmt2->execute([$prod_data_item[0]]);
            $product_specific_data_val = $stmt2->fetch(\PDO::FETCH_ASSOC);
            $spec->add_specific_item(
                $product_specific_data_val["id"],
                $prod_data_item[2],
                $product_specific_data_val["name"],
                $product_specific_data_val["name_ru"],
                $prod_data_item[1],
                $product_specific_data_val["unit"],
                $product_specific_data_val["is_filter"]
                ,$product_specific_data_val["is_visible"]
            );
        }
        return  $spec;
    }
    
    public function show_data_product(){
        if(!isset($_GET["id"])){
            die();
        }
        $spec = new \Modules\Shop\Modul\Specific;
        $spec->set_product_id($_GET["id"]);
        $spec->set_variant_id(0);
        $pdo = \Modules\Core\Modul\Sql::connect(); 
        $stmt = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_specific_data WHERE (product_id = ?) and (varianr_id = 0)");
        $stmt->execute([$spec->get_product_id()]);
        $prod_data = [];
        while($product_specific_data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $prod_data[] = [$product_specific_data["specific_id"],$product_specific_data["value"],$product_specific_data["id"]];
        }

        foreach( $prod_data as  $prod_data_item) {
            $stmt2 =  $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_specific_list WHERE id = ? LIMIT 1");
            $stmt2->execute([$prod_data_item[0]]);
            $product_specific_data_val = $stmt2->fetch(\PDO::FETCH_ASSOC);
            $spec->add_specific_item(
                $product_specific_data_val["id"],
                $prod_data_item[2],
                $product_specific_data_val["name"],
                $product_specific_data_val["name_ru"],
                $prod_data_item[1],
                $product_specific_data_val["unit"],
                $product_specific_data_val["is_filter"]
                ,$product_specific_data_val["is_visible"]
            );
        }
        return  $spec;
    }

    
    public function show_data_variant(){
        if(!isset($_GET["id"])){
            die();
        }
        if(!isset($_GET["id_prod"])){
            die();
        }$spec = new \Modules\Shop\Modul\Specific;
        $spec->set_product_id($_GET["id_prod"]);
        $spec->set_variant_id(0);
        $pdo = \Modules\Core\Modul\Sql::connect(); 
        $stmt = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_specific_data WHERE (product_id = ?) and (varianr_id = 0)");
        $stmt->execute([$spec->get_product_id()]);
        $prod_data = [];
        while($product_specific_data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $prod_data[] = [$product_specific_data["specific_id"],$product_specific_data["value"],$product_specific_data["id"]];
        }

        foreach( $prod_data as  $prod_data_item) {
            $stmt2 =  $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_specific_list WHERE id = ? LIMIT 1");
            $stmt2->execute([$prod_data_item[0]]);
            $product_specific_data_val = $stmt2->fetch(\PDO::FETCH_ASSOC);
            $spec->add_specific_item(
                $product_specific_data_val["id"],
                $prod_data_item[2],
                $product_specific_data_val["name"],
                $product_specific_data_val["name_ru"],
                $prod_data_item[1],
                $product_specific_data_val["unit"],
                $product_specific_data_val["is_filter"]
                ,$product_specific_data_val["is_visible"]
            );
        }

        $stmt = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_specific_data WHERE (product_id = ?) and (varianr_id = ?)");
        $stmt->execute([$spec->get_product_id(),$_GET["id"]]);
        
        $variant_data = [];
        while($product_specific_data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $variant_data[] = [$product_specific_data["specific_id"],$product_specific_data["value"],$product_specific_data["id"]];
        }
        $new_spec = [];
        foreach($spec-> get_specific() as $variant_spec){
            foreach($variant_data as $data){
                if($variant_spec[0] == $data[0]){
                    $variant_spec[4] = $data[1];
                }
            }
            $new_spec[] = $variant_spec;
        }
        $spec->set_specific($new_spec);
        return  $spec;
    }
   
    public function clear_no_active($list,$prod){
        foreach($list as $key => $item_list){
            foreach($prod->get_specific() as $item_spec){
                if($list[$key]->get_id() == $item_spec[0]){
                    $list[$key]->set_active('active');
                    $list[$key]->set_value_data($item_spec[4]);
                }
            }
        }
    }

    public function save_product(){
        if(!isset($_POST["save_boot_new_product"])){
            
            return [
                'job' => false,
                'result' => true,
                'id' => 0,
                'msg' => "Не начато"
            ];
        }
        
        $data_spec = [];            
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'spec_name_') === 0) {
                $blockId = str_replace('spec_name_', '', $key);                
                $inputValue = $_POST['value_data_' . $blockId] ?? '';
                if (!empty($value)) {
                    $data_spec[] = [$value, $inputValue];
                }
            }
        }
        $this->save_product_clean();
        return $this->save_product_data($data_spec);
    }

    public function save_varianrt(){
        if(!isset($_POST["save_boot_new_product"])){
            
            return [
                'job' => false,
                'result' => true,
                'id' => 0,
                'msg' => "Не начато"
            ];
        }
        
        $data_spec = [];            
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'spec_name_') === 0) {
                $blockId = str_replace('spec_name_', '', $key);                
                $inputValue = $_POST['value_data_' . $blockId] ?? '';
                if (!empty($value)) {
                    $data_spec[] = [$value, $inputValue];
                }
            }
        }
        $this->save_variant_clean();
        return $this->save_variant_data($data_spec);
    }
    public function save_variant_clean(){
        $pdo = \Modules\Core\Modul\Sql::connect();
        $stmt = $pdo->prepare("DELETE FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_specific_data WHERE (product_id = ?) AND (varianr_id = ?)");
        $stmt->execute([$_GET["id_prod"],$_GET["id"]]);
        $deletedCount = $stmt->rowCount();
    }
    public function save_product_clean(){
        $pdo = \Modules\Core\Modul\Sql::connect();
        $stmt = $pdo->prepare("DELETE FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_specific_data WHERE (product_id = ?) AND (varianr_id = 0)");
        $stmt->execute([$_GET["id"]]);
        $deletedCount = $stmt->rowCount();
    }

    public function save_product_data($data_spec){
        $pdo = \Modules\Core\Modul\Sql::connect();
        $productId = $_GET["id"];
        $insertSql = "INSERT INTO " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_specific_data 
              (specific_id, product_id, varianr_id, value, created_at) 
              VALUES (?, ?, 0, ?, NOW())";

        $insertStmt = $pdo->prepare($insertSql);

        foreach ($data_spec as $spec) {
            $specificId = $spec[0];   // Это $value из вашего кода
            $inputValue = $spec[1];   // Это $inputValue из вашего кода
            
            // Проверяем, что значения не пустые
            if (!empty($specificId) && !empty($inputValue)) {
                $insertStmt->execute([
                    $specificId,
                    $productId,
                    $inputValue
                ]);
            }
        }
        $insertedCount = $insertStmt->rowCount();
        
        return [
            'job' => true,
            'result' => true,
            'id' => 0,
            'msg' => "все ок"
        ];
    }

    public function save_variant_data($data_spec){
        $pdo = \Modules\Core\Modul\Sql::connect();
        $productId = $_GET["id_prod"];
        $variantId = $_GET["id"];
        $insertSql = "INSERT INTO " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_specific_data 
              (specific_id, product_id, varianr_id, value, created_at) 
              VALUES (?, ?, ?, ?, NOW())";

        $insertStmt = $pdo->prepare($insertSql);

        foreach ($data_spec as $spec) {
            $specificId = $spec[0];   // Это $value из вашего кода
            $inputValue = $spec[1];   // Это $inputValue из вашего кода
            
            // Проверяем, что значения не пустые
            if (!empty($specificId) && !empty($inputValue)) {
                $insertStmt->execute([
                    $specificId,
                    $productId,
                    $variantId,
                    $inputValue
                ]);
            }
        }
        $insertedCount = $insertStmt->rowCount();
        
        return [
            'job' => true,
            'result' => true,
            'id' => 0,
            'msg' => "все ок"
        ];
    }
    
    
}