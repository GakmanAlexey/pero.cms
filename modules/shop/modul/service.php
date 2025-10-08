<?php

namespace Modules\Shop\Modul;

class Service{
   
    public function getProductVariation($product_id, $variation_id){
        $productService = new \Modules\Shop\Modul\Productservice;
        $product = $productService->getProductById($product_id);

        $varianService = new \Modules\Shop\Modul\Variationservice;
        $product = $varianService->getProductVariantData($product, $variation_id);
        return $product;
    }
    
}