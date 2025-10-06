<?php

namespace Modules\Card\Modul;

class Cardoperation{    
    public function addToCart(\Modules\Card\Modul\Card $card, \Modules\Shop\Modul\Product $product, $count){
        $productList = $card->get_product_list();
        $found = false;
        
        foreach($productList as $cartProduct){
            if ($cartProduct->get_id() === $product->get_id()) {
                $cartProduct->set_count_buy_in_card($cartProduct->get_count_buy_in_card() + $count);
                $found = true;
                break;
            }
        }
        
        if(!$found){
            $newProduct = clone $product; 
            $newProduct->set_count_buy_in_card($count);
            $card->add_product_list($newProduct);
        }
        return $card;
    }   

    public function setCartItemQuantity(\Modules\Card\Modul\Card $card, \Modules\Shop\Modul\Product $product, $count){            
        $productList = $card->get_product_list();
        $found = false;
        
        foreach($productList as $key => $cartProduct){
            if ($cartProduct->get_id() === $product->get_id()) {
                $found = true;
                
                if ($count <= 0) {
                    unset($productList[$key]);
                } else {
                    $cartProduct->set_count_buy_in_card($count);
                }
                break;
            }
        }
        
        if (!$found && $count > 0) {
            $this->addToCart($card, $product, $count);
        } else {
            $card->set_product_list(array_values($productList));
        }        
        return $card;
    }   

    public function incrementCartItem(\Modules\Card\Modul\Card $card, \Modules\Shop\Modul\Product $product){
        $status = false;
        foreach($card->get_product_list() as $cartProduct){
            if ($cartProduct->get_id() === $product->get_id()) {
                $status = true;
                $cartProduct->set_count_buy_in_card($cartProduct->get_count_buy_in_card() + 1);
            }
        };
        if(!$status){
            $this->addToCart($card, $product, 1);
        }        
        return $card;
    }   

    public function decrementCartItem(\Modules\Card\Modul\Card $card, \Modules\Shop\Modul\Product $product){       
        $productList = $card->get_product_list();
        $found = false;
        
        foreach($productList as $key => $cartProduct){
            if ($cartProduct->get_id() === $product->get_id()) {
                $found = true;
                $currentCount = $cartProduct->get_count_buy_in_card();
                
                if ($currentCount > 1) {
                    $cartProduct->set_count_buy_in_card($currentCount - 1);
                } else {
                    unset($productList[$key]);
                }
                break;
            }
        }
        $card->set_product_list(array_values($productList));        
        return $card;
    }  

    public function isProductInCart(\Modules\Card\Modul\Card $card, \Modules\Shop\Modul\Product $product){
        foreach($card->get_product_list() as $cartProduct){
            if ($cartProduct->get_id() === $product->get_id()) {
                return true;
            }
        };
        return false;
    } 
}

    
