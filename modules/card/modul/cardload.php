<?php

namespace Modules\Card\Modul;

class Cardload {    
    public function load_auth(\Modules\Card\Modul\Card $card) {
        $card->set_user($_SESSION["id"]);
        $card = $this->sql_load_auth($card);
        return $card;
    } 
    
    public function sql_load_auth(\Modules\Card\Modul\Card $card) {
        $pdo = \Modules\Core\Modul\Sql::connect();
        $stmt = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_card WHERE user_id = ? LIMIT 1");
        $stmt->execute([$card->get_user()]);
        while($sql_data_card = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $card = $this->sql_to_card($card, $sql_data_card);
            return $card;
        }
        $sql_create = new \Modules\Card\Modul\Cardcreate;
        $card = $sql_create->create_auth($card);
        return $card;
    }
    
    public function load_no_auth(\Modules\Card\Modul\Card $card) {
        $card->set_guest(\Modules\User\Modul\Guest::getId());
        $card = $this->sql_load_no_auth($card);
        return $card;
    }
    
    public function sql_load_no_auth(\Modules\Card\Modul\Card $card) {
        $pdo = \Modules\Core\Modul\Sql::connect();
        $stmt = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_card WHERE guest_id = ? LIMIT 1");
        $stmt->execute([$card->get_guest()]);
        while($sql_data_card = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $card = $this->sql_to_card($card, $sql_data_card);
            return $card;
        }
        $sql_create = new \Modules\Card\Modul\Cardcreate;
        $card = $sql_create->create_no_auth($card);
        return $card;
    }

    public function sql_to_card(\Modules\Card\Modul\Card $card, $sql) {
        $card
            ->set_id($sql["id"])
            ->set_user($sql["user_id"])
            ->set_guest($sql["guest_id"])
            ->set_status($sql["status"])
            ->set_price($sql["price"])
            ->set_old_price($sql["old_price"])
            ->set_discount($sql["discount"])
            ->set_shipping_price($sql["shipping_price"])
            ->set_shipping_included($sql["shipping_included"])
            ->set_commission_bank($sql["commission_bank"])
            ->set_commission_included($sql["commission_included"])
            ->set_product_list($this->unserializeProduct($sql["product_list"]))
            ->set_created_at($sql["created_at"])
            ->set_updated_at($sql["updated_at"])
            ->set_expires_at($sql["expires_at"])
            ->set_ip_address($sql["ip_address"])
            ->set_user_agent($sql["user_agent"]);
        return $card;
    }

    public function unserializeProduct($productListSerial) {
        $arrayProductObject = [];
        
        // Обработка случая когда данные пустые или некорректные
        if (empty($productListSerial) || $productListSerial === 'b:0;') {
            return $arrayProductObject;
        }
        
        $prodList = unserialize($productListSerial);
        
        // Если это старый формат данных (без вариаций)
        if ($this->isOldFormat($prodList)) {
            return $this->unserializeOldFormat($prodList);
        }
        
        // Новый формат с вариациями
        return $this->unserializeNewFormat($prodList);
    }

    /**
     * Проверяет старый ли это формат данных [[product_id, quantity], ...]
     */
    private function isOldFormat($prodList) {
        if (!is_array($prodList) || empty($prodList)) {
            return false;
        }
        
        $firstItem = $prodList[0];
        return is_array($firstItem) && count($firstItem) === 2 && is_numeric($firstItem[0]);
    }

    /**
     * Загрузка старого формата данных (без вариаций)
     */
    private function unserializeOldFormat($prodList) {
        $arrayProductObject = [];
        foreach ($prodList as $productItem) {
            $productObject = new \Modules\Shop\Modul\Product;
            $productObject->set_id($productItem[0])
                         ->set_count_buy_in_card($productItem[1]);
            $arrayProductObject[] = $productObject;
        }
        return $arrayProductObject;
    }

    /**
     * Загрузка нового формата данных (с вариациями)
     */
    private function unserializeNewFormat($prodList) {
        $arrayProductObject = [];
        
        if (!is_array($prodList)) {
            return $arrayProductObject;
        }
        
        foreach ($prodList as $productData) {
            $productObject = new \Modules\Shop\Modul\Product;
            $productObject->set_id($productData['product_id'])
                         ->set_count_buy_in_card($productData['quantity']);
            
            // Восстанавливаем вариации если они есть
            if (!empty($productData['variations']) && is_array($productData['variations'])) {
                $variations = $this->restoreVariations($productData['variations']);
                $productObject->set_variations($variations);
            }
            
            $arrayProductObject[] = $productObject;
        }
        
        return $arrayProductObject;
    }

    /**
     * Восстанавливает объекты Variation из массива ID
     */
    private function restoreVariations($variationIds) {
        $variations = [];
        
        foreach ($variationIds as $variationId) {
            $variation = new \Modules\Shop\Modul\Variation;
            $variation->set_id($variationId);
            $variations[] = $variation;
        }
        
        return $variations;
    }
}