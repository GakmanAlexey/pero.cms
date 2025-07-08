<?php

namespace Modules\Shop\Modul;

class Productlist{
    
    public function get_active_in_categor($categor_id){
        $product_list = [];
        
        $pdo = \Modules\Core\Modul\Sql::connect(); 
        $stmt2 = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_product WHERE category_id = ? and is_active = 1");
        $stmt2->execute([$categor_id]);
        
        while($product_data = $stmt2->fetch(\PDO::FETCH_ASSOC)){
            $spec = new \Modules\Shop\Modul\Specificservice;
            $product = new  \Modules\Shop\Modul\Product();
            $product->set_id($product_data["id"])
                ->set_external_guid($product_data["external_guid"])
                ->set_external_code($product_data["external_code"])
                ->set_article($product_data["article"])
                ->set_name($product_data["name"])
                ->set_name_ru($product_data["name_ru"])
                ->set_url_full($product_data["url_full"])
                ->set_url_block($product_data["url_block"])
                ->set_description($product_data["description"])
                ->set_text($product_data["text"])
                ->set_price($product_data["price"])
                ->set_old_price($product_data["old_price"])
                ->set_currency($product_data["currency"])
                ->set_is_active($product_data["is_active"])
                ->set_in_stock($product_data["in_stock"])
                ->set_quantity($product_data["quantity"])
                ->set_brand_id($product_data["brand_id"])
                ->set_category_id($product_data["category_id"])
                ->set_main_image($product_data["main_image"])
                ->set_images(unserialize($product_data["images"]))
                ->set_sync_date($product_data["sync_date"])
                ->set_is_sync_with_1c($product_data["is_sync_with_1c"])
                ->set_has_variations($product_data["has_variations"])
                ->set_variations([])
                ->set_attributes([])
                ->set_tags([])
                ->set_sku($product_data["sku"])
                ->set_views_count($product_data["views_count"])
                ->set_barcode($product_data["barcode"])
                ->set_width($product_data["width"])
                ->set_height($product_data["height"])
                ->set_length($product_data["length"])
                ->set_weight($product_data["weight"])
                ->set_created_at($product_data["created_at"])
                ->set_updated_at($product_data["updated_at"])
                ->set_deleted_at($product_data["deleted_at"]);
                $product->set_specific($spec->show_data_product_id( $product->get_id()));                
            $product_list[] = $product;
        }
        return $product_list;
    }

    public function logic_open_categor(){
        $tcat = new \Modules\Shop\Modul\Takecatalog;
        $categor = $tcat->take_categor_open();
        //var_dump($categor->get_id());
        $categor->set_list_product($this->get_active_in_categor($categor->get_id()));
        return $categor;
    }
}

    