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

        return $card;
    }
}