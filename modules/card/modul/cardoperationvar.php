<?php

namespace Modules\Card\Modul;

class Cardoperationvar {   //variants 
    
    public function addToCart(\Modules\Card\Modul\Card $card, \Modules\Shop\Modul\Product $product, $count) {
        $productList = $card->get_product_list();
        $productVariations = $product->get_variations();
        $hasVariations = !empty($productVariations) && !$this->isEmptyVariations($productVariations);
        
        if (!$hasVariations) {
            return $this->addSimpleProductToCart($card, $product, $count);
        }
        
        return $this->addProductWithVariationsToCart($card, $product, $count, $productVariations);
    }
    
    private function addSimpleProductToCart(\Modules\Card\Modul\Card $card, \Modules\Shop\Modul\Product $product, $count) {
        $productList = $card->get_product_list();
        $found = false;        
        foreach ($productList as $cartProduct) {
            if ($cartProduct->get_id() === $product->get_id()) {
                $cartProduct->set_count_buy_in_card($cartProduct->get_count_buy_in_card() + $count);
                $found = true;
                break;
            }
        }        
        if (!$found) {
            $newProduct = clone $product; 
            $newProduct->set_count_buy_in_card($count);
            $card->add_product_list($newProduct);
        }        
        return $card;
    }
    
    private function addProductWithVariationsToCart(\Modules\Card\Modul\Card $card, \Modules\Shop\Modul\Product $product, $count, array $productVariations) {
        $productList = $card->get_product_list();
        $found = false;
        
        foreach ($productList as $cartProduct) {
            if ($cartProduct->get_id() !== $product->get_id()) {
                continue;
            }            
            $cartVariations = $cartProduct->get_variations();
            $productVariantIds = $this->getVariantIds($productVariations);
            $cartVariantIds = $this->getVariantIds($cartVariations);
            
            if ($productVariantIds == $cartVariantIds) {
                $cartProduct->set_count_buy_in_card($cartProduct->get_count_buy_in_card() + $count);
                $found = true;
                break;
            }
        }
        
        if (!$found) {
            $newProduct = clone $product;
            $newProduct->set_count_buy_in_card($count);
            $newVariations = [];
            foreach ($productVariations as $variant) {
                $newVariations[] = clone $variant;
            }
            $newProduct->set_variations($newVariations);
            
            $card->add_product_list($newProduct);
        }
        
        return $card;
    } 

    public function setCartItemQuantity(\Modules\Card\Modul\Card $card, \Modules\Shop\Modul\Product $product, $count) {
        $productList = $card->get_product_list();
        $productVariations = $product->get_variations();
        $hasVariations = !empty($productVariations) && !$this->isEmptyVariations($productVariations);
        $found = false;
        
        foreach ($productList as $key => $cartProduct) {
            if ($cartProduct->get_id() !== $product->get_id()) {
                continue;
            }
            
            if ($hasVariations && !$this->hasSameVariations($cartProduct, $product)) {
                continue;
            }
            
            $found = true;
            
            if ($count <= 0) {
                unset($productList[$key]);
            } else {
                $cartProduct->set_count_buy_in_card($count);
            }
            break;
        }
        
        if (!$found && $count > 0) {
            $this->addToCart($card, $product, $count);
        } else {
            $card->set_product_list(array_values($productList));
        }
        
        return $card;
    }  

    public function incrementCartItem(\Modules\Card\Modul\Card $card, \Modules\Shop\Modul\Product $product) {
        $productList = $card->get_product_list();
        $productVariations = $product->get_variations();
        $hasVariations = !empty($productVariations) && !$this->isEmptyVariations($productVariations);
        $found = false;        
        foreach ($productList as $cartProduct) {
            if ($cartProduct->get_id() !== $product->get_id()) {
                continue;
            }
            if ($hasVariations) {
                if ($this->hasSameVariations($cartProduct, $product)) {
                    $found = true;
                    $cartProduct->set_count_buy_in_card($cartProduct->get_count_buy_in_card() + 1);
                    break;
                }
            } else {
                $found = true;
                $cartProduct->set_count_buy_in_card($cartProduct->get_count_buy_in_card() + 1);
                break;
            }
        }        
        if (!$found) {
            $this->addToCart($card, $product, 1);
        }        
        return $card;
    }  

    public function decrementCartItem(\Modules\Card\Modul\Card $card, \Modules\Shop\Modul\Product $product) {
        $productList = $card->get_product_list();
        $productVariations = $product->get_variations();
        $hasVariations = !empty($productVariations) && !$this->isEmptyVariations($productVariations);
        $found = false;        
        foreach ($productList as $key => $cartProduct) {
            if ($cartProduct->get_id() !== $product->get_id()) {
                continue;
            }            
            if ($hasVariations && !$this->hasSameVariations($cartProduct, $product)) {
                continue;
            }            
            $found = true;
            $currentCount = $cartProduct->get_count_buy_in_card();            
            if ($currentCount > 1) {
                $cartProduct->set_count_buy_in_card($currentCount - 1);
            } else {
                unset($productList[$key]);
            }
            break;
        }
        
        $card->set_product_list(array_values($productList));
        return $card;
    }

    public function removeCartItem(\Modules\Card\Modul\Card $card, \Modules\Shop\Modul\Product $product) {
        $productList = $card->get_product_list();
        
        foreach ($productList as $key => $cartProduct) {
            if ($cartProduct->get_id() !== $product->get_id()) {
                continue;
            }
            
            if (!$this->hasSameVariations($cartProduct, $product)) {
                continue;
            }
            
            unset($productList[$key]);
            break;
        }
        
        $card->set_product_list(array_values($productList));
        return $card;
    }

    public function isProductInCart(\Modules\Card\Modul\Card $card, \Modules\Shop\Modul\Product $product) {
        foreach ($card->get_product_list() as $cartProduct) {
            if ($cartProduct->get_id() !== $product->get_id()) {
                continue;
            }            
            
            $cartVariations = $cartProduct->get_variations();
            $productVariations = $product->get_variations();            
            
            // ОБА товара должны иметь пустые вариации
            $cartHasEmptyVariations = empty($cartVariations) || $this->isEmptyVariations($cartVariations);
            $productHasEmptyVariations = empty($productVariations) || $this->isEmptyVariations($productVariations);
            
            if ($cartHasEmptyVariations && $productHasEmptyVariations) {
                return true;
            }
                
            // Если есть вариации - проверяем совпадение
            foreach ($cartVariations as $cartVariant) {
                foreach ($productVariations as $productVariant) {
                    if ($cartVariant->get_id() === $productVariant->get_id()) {
                        return true;
                    }
                }
            }
        }        
        return false;
    }
    
    
    private function isEmptyVariations(array $variations): bool {
        if (empty($variations)) {
            return true;
        }
        if (count($variations) === 1) {
            $first = $variations[0];
            if ($first === "" || $first === null) {
                return true;
            }
        }
        foreach ($variations as $variant) {
            if ($variant instanceof \Modules\Shop\Modul\Variation) {
                return false;
            }
            if (is_string($variant) && trim($variant) !== "") {
                return false;
            }
            if ($variant !== null && $variant !== "") {
                return false;
            }
        }
        
        return true;
    }
    
    private function getVariantIds(array $variations): array {
        $ids = [];
        foreach ($variations as $variant) {
            if (is_object($variant) && method_exists($variant, 'get_id')) {
                $ids[] = $variant->get_id();
            } elseif (is_string($variant) && $variant !== "") {
                $ids[] = $variant;
            }
        }
        sort($ids);
        return $ids;
    }
    
    private function hasSameVariations($cartProduct, $product): bool {
        $cartVariations = $cartProduct->get_variations();
        $productVariations = $product->get_variations();
        
        if (empty($cartVariations) && empty($productVariations)) {
            return true;
        }
        
        if (empty($cartVariations) !== empty($productVariations)) {
            return false;
        }
        
        $cartVariantIds = $this->getVariantIds($cartVariations);
        $productVariantIds = $this->getVariantIds($productVariations);
        
        return $cartVariantIds == $productVariantIds;
    }

    public function getProductQuantity(\Modules\Card\Modul\Card $card, \Modules\Shop\Modul\Product $product): int   {
        $quantity = 0;
        foreach ($card->get_product_list() as $cartProduct) {
            if ($this->isSameProduct($cartProduct, $product)) {
                $quantity += $cartProduct->get_count_buy_in_card();
            }
        }
        return $quantity;
    }

    public function clearCart(\Modules\Card\Modul\Card $card): \Modules\Card\Modul\Card{
        $card->set_product_list([]);
        return $card;
    }
}