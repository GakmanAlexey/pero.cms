<?php

namespace Modules\Card\Modul;

class Cardsave {    
    public function save(\Modules\Card\Modul\Card $card) {
        $array_card = [];
        
        $array_card["status"] = $card->get_status();
        $array_card["price"] = $card->get_price();
        $array_card["old_price"] = $card->get_old_price();
        $array_card["discount"] = $card->get_discount();
        $array_card["shipping_price"] = $card->get_shipping_price();
        $array_card["shipping_included"] = $card->get_shipping_included();
        $array_card["commission_bank"] = $card->get_commission_bank();
        $array_card["commission_included"] = $card->get_commission_included();
        $array_card["user_id"] = $card->get_user();
        $array_card["guest_id"] = $card->get_guest();
        $array_card["product_list"] = $this->convertProductToArray($card->get_product_list());
        $array_card["updated_at"] = $card->get_updated_at();
        $array_card["expires_at"] = $card->get_expires_at();
        $array_card["session_id"] = $card->get_session_id();
        $array_card["currency"] = $card->get_currency();
        $array_card["total_weight"] = $card->get_total_weight();
        $array_card["items_count"] = $card->get_items_count();
        $array_card["total_quantity"] = $card->get_total_quantity();
        $array_card["coupon_code"] = $card->get_coupon_code();
        $array_card["coupon_discount"] = $card->get_coupon_discount();
        $array_card["tax_amount"] = $card->get_tax_amount();
        $array_card["notes"] = $card->get_notes();
        $array_card["ip_address"] = $card->get_ip_address();
        $array_card["user_agent"] = $card->get_user_agent();
        $array_card["delivery_type"] = "";////////////////
        $array_card["payment_method"] = "";////////////////
        $array_card["delivery_address"] = "";////////////////
        $array_card["contact_phone"] = "";////////////////
        $array_card["contact_email"] = "";////////////////
        
        $result = $this->saveToSql($card->get_id(), $array_card);
        return $result;
    } 

    public function convertProductToArray($productArray) {
        if (empty($productArray)) {
            return serialize([]);
        }
        
        $newArrayProduct = [];
        foreach ($productArray as $product) {
            $productData = [
                'product_id' => $product->get_id(),
                'quantity' => $product->get_count_buy_in_card(),
                'variations' => $this->convertVariationsToArray($product->get_variations())
            ];
            $newArrayProduct[] = $productData;
        }
        
        return serialize($newArrayProduct);
    }

    private function convertVariationsToArray($variations) {
        if (empty($variations)) {
            return [];
        }
        
        $variationIds = [];
        foreach ($variations as $variation) {
            if ($variation instanceof \Modules\Shop\Modul\Variation) {
                // Сохраняем только ID вариации
                $variationIds[] = $variation->get_id();
            }
            // Пустые строки, null и не-объекты игнорируем
        }
        
        return $variationIds;
    }

    public function saveToSql($id, $array_card) {
        try {
            $pdo = \Modules\Core\Modul\Sql::connect();
            $stmt = $pdo->prepare("UPDATE " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_card SET 
                status = ?, 
                price = ?, 
                old_price = ?, 
                discount = ?, 
                shipping_price = ?, 
                shipping_included = ?, 
                commission_bank = ?, 
                commission_included = ?, 
                user_id = ?, 
                guest_id = ?, 
                product_list = ?, 
                updated_at = ?,  
                expires_at = ?,  
                session_id = ?,  
                currency = ?,  
                total_weight = ?,  
                items_count = ?,  
                total_quantity = ?,  
                coupon_code = ?,  
                coupon_discount = ?,  
                tax_amount = ?,  
                notes = ?,  
                ip_address = ?,  
                user_agent = ?, 
                delivery_type = ?, 
                payment_method = ?, 
                delivery_address = ?, 
                contact_phone = ?, 
                contact_email = ? 
                WHERE id = ?");
                
            $result = $stmt->execute([
                $array_card["status"],
                $array_card["price"],
                $array_card["old_price"],
                $array_card["discount"],
                $array_card["shipping_price"],
                $array_card["shipping_included"],
                $array_card["commission_bank"],
                $array_card["commission_included"],
                $array_card["user_id"],
                $array_card["guest_id"],
                $array_card["product_list"],
                $array_card["updated_at"],
                $array_card["expires_at"],
                $array_card["session_id"],
                $array_card["currency"],
                $array_card["total_weight"],
                $array_card["items_count"],
                $array_card["total_quantity"],
                $array_card["coupon_code"],
                $array_card["coupon_discount"],
                $array_card["tax_amount"],
                $array_card["notes"],
                $array_card["ip_address"],
                $array_card["user_agent"],
                $array_card["delivery_type"],
                $array_card["payment_method"],
                $array_card["delivery_address"],
                $array_card["contact_phone"],
                $array_card["contact_email"],
                $id
            ]);
            
            if ($stmt->rowCount() > 0) {                
                return [
                    'success' => true,
                    'new_status' => 'Корзина сохранена'
                ];
            } else {                
                return [
                    'success' => false,
                    'new_status' => 'Сбой сохранения корзины'
                ];
            }
             
        } catch (\PDOException $e) {              
            return [
                'success' => false,
                'new_status' => 'Неизвестная ошибка: ' . $e->getMessage()
            ];
        }
    }
    
    // Метод для загрузки корзины (добавь в класс Cardmeneger или здесь)
    public function loadProductFromArray($serializedData) {
        $productArray = unserialize($serializedData);
        $products = [];
        
        if (empty($productArray)) {
            return $products;
        }
        
        foreach ($productArray as $item) {
            $product = new \Modules\Shop\Modul\Product;
            $product->set_id($item['product_id']);
            $product->set_count_buy_in_card($item['quantity']);
            
            // Восстанавливаем вариации
            if (!empty($item['variations'])) {
                $variations = $this->restoreVariationsFromArray($item['variations']);
                $product->set_variations($variations);
            }
            
            $products[] = $product;
        }
        
        return $products;
    }

    private function restoreVariationsFromArray($variationIds) {
        $variations = [];
        
        foreach ($variationIds as $variationId) {
            // Создаем объект Variation только с ID
            $variation = new \Modules\Shop\Modul\Variation;
            $variation->set_id($variationId);
            $variations[] = $variation;
        }
        
        return $variations;
    }
}