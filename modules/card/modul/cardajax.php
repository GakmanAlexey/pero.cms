<?php

namespace Modules\Card\Modul;

class Cardajax {    
   
    public function viewCountProduct() {
        $cm = new \Modules\Card\Modul\Cardmeneger;
        $cm::load();
        $card = $cm::$card; 
        $cardManager = new \Modules\Card\Modul\Cardmeneger;
        $count = $cardManager->countProduct($card);
        return $count;
    }
    
    public function addToCart($productId, $variationId = null, $quantity = 1) {
        try {
            $cm = new \Modules\Card\Modul\Cardmeneger;
            $cm::load();
            $card = $cm::$card;
            
            $oper = new \Modules\Card\Modul\Cardoperationvar;
            
            // Создаем продукт
            $product = new \Modules\Shop\Modul\Product;
            $product->set_id($productId);
            
            // Добавляем вариацию если есть
            if ($variationId) {
                $variation = new \Modules\Shop\Modul\Variation;
                $variation->set_id($variationId);
                $product->set_variations([$variation]);
            }
            
            // Добавляем в корзину
            $oper->addToCart($card, $product, $quantity);
            
            // Сохраняем корзину
            $saveCard = new \Modules\Card\Modul\Cardsave;
            $saveResult = $saveCard->save($card);
            
            return [
                'success' => true,
                'message' => 'Товар добавлен в корзину',
                'new_count' => $this->viewCountProduct(),
                'product_id' => $productId,
                'variation_id' => $variationId
            ];
            
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Ошибка при добавлении товара: ' . $e->getMessage()
            ];
        }
    }
    
    public function removeFromCart($productId, $variationId = null, $quantity = 1) {
        try {
            $cm = new \Modules\Card\Modul\Cardmeneger;
            $cm::load();
            $card = $cm::$card;
            
            $oper = new \Modules\Card\Modul\Cardoperationvar;
            
            // Создаем продукт
            $product = new \Modules\Shop\Modul\Product;
            $product->set_id($productId);
            
            // Добавляем вариацию если есть
            if ($variationId) {
                $variation = new \Modules\Shop\Modul\Variation;
                $variation->set_id($variationId);
                $product->set_variations([$variation]);
            }
            
            // Уменьшаем количество или удаляем
            $oper->decrementCartItem($card, $product);
            
            // Сохраняем корзину
            $saveCard = new \Modules\Card\Modul\Cardsave;
            $saveResult = $saveCard->save($card);
            
            return [
                'success' => true,
                'message' => 'Количество товара уменьшено',
                'new_count' => $this->viewCountProduct(),
                'product_id' => $productId,
                'variation_id' => $variationId
            ];
            
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Ошибка при изменении количества: ' . $e->getMessage()
            ];
        }
    }
    
    public function deleteFromCart($productId, $variationId = null) {
        try {
            $cm = new \Modules\Card\Modul\Cardmeneger;
            $cm::load();
            $card = $cm::$card;
            
            $oper = new \Modules\Card\Modul\Cardoperationvar;
            
            // Создаем продукт
            $product = new \Modules\Shop\Modul\Product;
            $product->set_id($productId);
            
            // Добавляем вариацию если есть
            if ($variationId) {
                $variation = new \Modules\Shop\Modul\Variation;
                $variation->set_id($variationId);
                $product->set_variations([$variation]);
            }
            
            // Удаляем товар
            $oper->removeCartItem($card, $product);
            
            // Сохраняем корзину
            $saveCard = new \Modules\Card\Modul\Cardsave;
            $saveResult = $saveCard->save($card);
            
            return [
                'success' => true,
                'message' => 'Товар удален из корзины',
                'new_count' => $this->viewCountProduct(),
                'product_id' => $productId,
                'variation_id' => $variationId
            ];
            
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Ошибка при удалении товара: ' . $e->getMessage()
            ];
        }
    }
    
    public function updateQuantity($productId, $variationId = null, $quantity = 1) {
        try {
            $cm = new \Modules\Card\Modul\Cardmeneger;
            $cm::load();
            $card = $cm::$card;
            
            $oper = new \Modules\Card\Modul\Cardoperationvar;
            
            $product = new \Modules\Shop\Modul\Product;
            $product->set_id($productId);
            
            if (!empty($variationId)) {
                $variation = new \Modules\Shop\Modul\Variation;
                $variation->set_id($variationId);
                $product->set_variations([$variation]);
            }
            $oper->setCartItemQuantity($card, $product, $quantity);
            
            $saveCard = new \Modules\Card\Modul\Cardsave;
            $saveResult = $saveCard->save($card);
            
            return [
                'success' => true,
                'message' => 'Количество товара обновлено',
                'new_count' => $this->viewCountProduct(),
                'product_id' => $productId,
                'variation_id' => $variationId,
                'quantity' => $quantity
            ];
            
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Ошибка при обновлении количества: ' . $e->getMessage()
            ];
        }
    }
    
    public function getPriceInfo() {
        $cm = new \Modules\Card\Modul\Cardmeneger;
        $cm::load();
        $card = $cm::$card;
        
        return [
            'total_price' => $card->get_price(),
            'old_price' => $card->get_old_price(),
            'discount' => $card->get_discount(),
            'items_count' => $card->get_items_count(),
            'total_quantity' => $card->get_total_quantity()
        ];
    }
    
    public function getCartInfo() {
        $cm = new \Modules\Card\Modul\Cardmeneger;
        $cm::load();
        $card = $cm::$card;
        
        $products = [];
        foreach ($card->get_product_list() as $cartProduct) {
            $productInfo = [
                'product_id' => $cartProduct->get_id(),
                'quantity' => $cartProduct->get_count_buy_in_card(),
                'name' => $cartProduct->get_name(),
                'price' => $cartProduct->get_price()
            ];
            
            // Добавляем информацию о вариациях
            $variations = $cartProduct->get_variations();
            if (!empty($variations)) {
                $productInfo['variations'] = [];
                foreach ($variations as $variant) {
                    if ($variant instanceof \Modules\Shop\Modul\Variation) {
                        $productInfo['variations'][] = [
                            'variation_id' => $variant->get_id(),
                            'name' => $variant->get_name()
                        ];
                    }
                }
            }
            
            $products[] = $productInfo;
        }
        
        return [
            'products' => $products,
            'total_price' => $card->get_price(),
            'total_quantity' => $card->get_total_quantity(),
            'items_count' => $card->get_items_count()
        ];
    }
}