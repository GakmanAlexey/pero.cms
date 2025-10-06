<?php

namespace Modules\Card\Modul;

class Cardload{    
    public function load_auth(\Modules\Card\Modul\Card $card){
        $card->set_user($_SESSION["id"]);
        $card = $this->sql_load_auth($card);
        return $card;
    } 
    
    public function sql_load_auth(\Modules\Card\Modul\Card $card){
        $pdo = \Modules\Core\Modul\Sql::connect();
        $stmt = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_card WHERE user_id  = ? LIMIT 1");
        $stmt->execute([$card->get_user()]);
        while($sql_data_card = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $card = $this->sql_to_card($card, $sql_data_card);
            return $card;
        }
        $sql_create = new \Modules\Card\Modul\Cardcreate;
        $card = $sql_create->create_auth($card);
        return $card;

    }
    
    public function load_no_auth(\Modules\Card\Modul\Card $card){
        $card->set_guest(\Modules\User\Modul\Guest::getId());
        $card = $this->sql_load_no_auth($card);
        return $card;
    }
    
    public function sql_load_no_auth(\Modules\Card\Modul\Card $card){
        $pdo = \Modules\Core\Modul\Sql::connect();
        $stmt = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_card WHERE guest_id  = ? LIMIT 1");
        $stmt->execute([$card->get_guest()]);
        while($sql_data_card = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $card = $this->sql_to_card($card, $sql_data_card);
            return $card;
        }
        $sql_create = new \Modules\Card\Modul\Cardcreate;
        $card = $sql_create->create_no_auth($card);
        return $card;

    }



    public function sql_to_card(\Modules\Card\Modul\Card $card, $sql){
        //var_dump(unserialize($sql["product_list"]));
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

    public function unserializeProduct($productListSerial){
        $arrayProductObject = [];
        $prodList = unserialize($productListSerial);
        foreach($prodList as $productItem){
            $productObject =  new \Modules\Shop\Modul\Product;
            $productObject->set_id($productItem[0])->set_count_buy_in_card($productItem[1]);
            $arrayProductObject[] = $productObject;
        }
        return $arrayProductObject;
    }

    

    
}

    
