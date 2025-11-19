<?php

namespace Modules\Card\Modul;

class Cardloaddata {    
    public function load(\Modules\Card\Modul\Card $card){
        // очистить от дубликатов
        $cardIssetProduct = new \Modules\Card\Modul\Cardissetproduct;
        $card = $cardIssetProduct->validateCartItems($card);
        // Загрузить данные товаров
        $card = $this->reLoadProductData($card);
        // Расчитать итоговые значения.
        $card = $this->updateOtherData($card);

        return $card;
    }

    public function reLoadProductData(\Modules\Card\Modul\Card $card){        
        $productList = $card->get_product_list();
        $validProducts = [];
        $productService = new \Modules\Shop\Modul\Productservice;
        $variantService = new \Modules\Shop\Modul\Variationservice;
        foreach ($productList as $product) {
            $productId = $product->get_id();
            $quantity = $product->get_count_buy_in_card();
            $variationId = 0;
            $variations = $product->get_variations();
            // тут мы обновляем данные товаров без вариаций
            $product = $productService->getProduct($product);
            $product->set_variations($variations);
            //тут мы обновляем данные товаро с вариациями
            if (!empty($variations)) {
                $variationId = $variations[0]->get_id();
                $product =  $variantService->getProductVariantDataSet($product, $variationId);
                $productsss= $product->get_variations();
            } 

            $validProducts[] = $product;
        }
        $card->set_product_list($validProducts);
        return $card;
    }

    public function updateOtherData(\Modules\Card\Modul\Card $card){
        $card = $this->calculatePrice($card);
        $card = $this->calculateDiscount($card);
        return $card;
    }

    public function calculatePrice(\Modules\Card\Modul\Card $card){
        $productList = $card->get_product_list();
        $priceFull = 0;
        $priceOldFull = 0;
        foreach ($productList as $product) {
            $productId = $product->get_id();
            $quantity = $product->get_count_buy_in_card();            
            $variations = $product->get_variations();
            if (!empty($variations)) {
                $price = $variations[0]->get_price();
                $priceOld = $variations[0]->get_old_price();
            }else{
                $price = $product->get_price();
                $priceOld = $product->get_old_price();
            }
            $priceFull = $priceFull + ($price * $quantity);
            $priceOldFull = $priceOldFull + ($priceOld * $quantity);
        }
        $card->set_price($priceFull);
        $card->set_old_price($priceOldFull);
        return $card;
    }

    public function calculateDiscount(\Modules\Card\Modul\Card $card){
        $card->set_discount(($card->get_old_price() - $card->get_price()));
        return $card;
    }
}