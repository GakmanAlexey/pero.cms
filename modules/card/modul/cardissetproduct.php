<?php

namespace Modules\Card\Modul;

class Cardissetproduct {    
    public function validateCartItems(\Modules\Card\Modul\Card $card){
        $validProducts = [];
        $productList = $card->get_product_list();
        
        foreach ($productList as $product) {
            $productId = $product->get_id();
            $quantity = $product->get_count_buy_in_card();
            $variationId = 0;
            $variations = $product->get_variations();
            if (!empty($variations)) {
                $variationId = $variations[0]->get_id();
            }
            if ($this->canAddToCart($productId, $quantity, $variationId)) {
                $validProducts[] = $product;
            }
        }
        $card->set_product_list($validProducts);
        return $card;
    }

    public function canAddToCart($productId, $quantity = 1, $variationId = 0){
        if (!$this->productExistsID($productId, $variationId)) {
            return false;
        }
        return $this->isQuantityAvailable($productId, $quantity, $variationId);
    }

    public function canAddToCartObject(\Modules\Shop\Modul\Product $product, $quantity = 1){
        if (!$this->productExistsObject($product)) {
            return false;
        }
        $idProduct = $product->get_id();
        $variations = $product->get_variations();
        if(!empty($variations)){
            $variationsId = $variations[0]->get_id();
        }else{
            $variationsId = 0;
        }
        return $this->isQuantityAvailable($idProduct, $quantity, $variationsId);
    }

    public function productExistsObject(\Modules\Shop\Modul\Product $product){
        $idProduct = $product->get_id();
        $variations = $product->get_variations(); 
        if(!empty($variations)){
            $variationsId = $variations[0]->get_id();
        }else{
            $variationsId = 0;
        }
        return $this->productExistsID($idProduct, $variationsId); 
    }

    public function productExistsID($productId, $variationId = 0){
        $pdo = \Modules\Core\Modul\Sql::connect();
        if($variationId == 0){
            $tableName = \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_product";            
            $sql = "SELECT id FROM $tableName WHERE id = ? AND is_active = 1 LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$productId]);            
            return $stmt->fetchColumn() > 0;
        }else{
            $tableName = \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_variation";
            $sql = "SELECT id FROM $tableName WHERE product_id = ? AND id = ? AND is_active = 1 LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$productId, $variationId]);            
            return $stmt->fetchColumn() > 0;
        }
    }

    public function isQuantityAvailable($productId, $quantity = 1, $variationId = 0){
        $pdo = \Modules\Core\Modul\Sql::connect();        
        if($variationId == 0){
            $tableName = \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_product";  
            $sql = "SELECT id FROM $tableName WHERE id = ? AND is_active = 1 LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$productId]);            
            $stock = (int)$stmt->fetchColumn();            
            return $stock >= $quantity;
        }else{
            $tableName = \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_variation";
            $sql = "SELECT id FROM $tableName WHERE ((product_id = ? AND id = ?) AND is_active = 1) LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$productId, $variationId]);            
            $stock = (int)$stmt->fetchColumn();            
            return $stock >= $quantity;
        }
    }
}