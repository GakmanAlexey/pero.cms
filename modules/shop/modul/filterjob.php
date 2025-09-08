<?php

namespace Modules\Shop\Modul;

class Filterjob{
    public function get_Apply($array_product){
        $new_array_product = [];
        foreach($array_product->get_list_product() as $product){
           $this->clean_price($product);
           $this->clean_isset($product);
           $this->clean_param($product);
           foreach($product->get_variations() as $product_item){
                $this->clean_price_variant($product_item);
                $this->clean_isset_variant($product_item);
                $this->clean_param_variant($product_item);
           }
           $new_array_product[] = $product;
        }
        $array_product->set_list_product($new_array_product);
        return $array_product;
    }

    public function clean_price_variant($product_item){
        $main_price = $product_item->get_price();
        if(isset( $_GET["min_price"])){
            if((int)$main_price < $_GET["min_price"]){
                $product_item->set_status_filter_false();
                return true;
            }
        }
        if(isset( $_GET["max_price"])){
            if((int)$main_price > $_GET["max_price"]){
                $product_item->set_status_filter_false();
                return true;
            }
        }     
        return false;
    }
    public function clean_isset_variant($product_item){
        
    }
    public function clean_param_variant($product_item) {
        // Если нет выбранных параметров в фильтре - вариация проходит проверку
        if (empty($_GET) || !$this->hasFilterParams($_GET)) {
            return false;
        }
    
        $hasMismatch = false;
    
        // Проверяем каждый параметр из GET-запроса
        foreach ($_GET as $paramKey => $paramValues) {
            // Пропускаем стандартные параметры (цену, опции и т.д.)
            if (in_array($paramKey, ['min_price', 'max_price', 'options'])) {
                continue;
            }
    
            // Получаем значение атрибута вариации
            $variantAttributeValue = $product_item->get_attribute($paramKey);
            
            // Если параметр есть в фильтре, но отсутствует у вариации - вариация не подходит
            if (empty($variantAttributeValue)) {
                $hasMismatch = true;
                continue; // Продолжаем проверять другие параметры
            }
    
            // Проверяем, есть ли хотя бы одно значение из фильтра в атрибутах вариации
            $filterValues = is_array($paramValues) ? $paramValues : [$paramValues];
            
            $hasMatchForThisParam = false;
            foreach ($filterValues as $filterValue) {
                if ($this->valuesMatch($variantAttributeValue, $filterValue)) {
                    $hasMatchForThisParam = true;
                    break;
                }
            }
            
            // Если ни одно значение не совпало для этого параметра - вариация не подходит
            if (!$hasMatchForThisParam) {
                $hasMismatch = true;
            }
        }
        
        if ($hasMismatch) {
            $product_item->set_status_filter_false();
            return true;
        }
        
        return false;
    }
    public function clean_price($product){
        $main_price = $product->get_price();
        if(isset( $_GET["min_price"])){
            if((int)$main_price < $_GET["min_price"]){
                $product->set_status_filter_false();
                return true;
            }
        }
        if(isset( $_GET["max_price"])){
            if((int)$main_price > $_GET["max_price"]){
                $product->set_status_filter_false();
                return true;
            }
        }     
        return false;
    }

    public function clean_isset($product){
        return false;
    }

    public function clean_param($product) {
        // Если нет выбранных параметров в фильтре - товар проходит проверку
        if (empty($_GET) || !$this->hasFilterParams($_GET)) {
            return false;
        }
    
        $productSpecs = $product->get_specific();
        
        // Если у товара нет характеристик, а в фильтре есть - товар не подходит
        if (empty($productSpecs)) {            
            $product->set_status_filter_false();
            return true;
        }
    
        // Преобразуем спецификации товара в удобный формат
        $productSpecsMap = $this->prepareProductSpecs($productSpecs);
        
        // Проверяем каждый параметр из GET-запроса
        foreach ($_GET as $paramKey => $paramValues) {
            // Пропускаем стандартные параметры (цену, опции и т.д.)
            if (in_array($paramKey, ['min_price', 'max_price', 'options'])) {
                continue;
            }
    
            // Если параметр есть в фильтре, но отсутствует у товара - товар не подходит
            if (!isset($productSpecsMap[$paramKey])) {                
                $product->set_status_filter_false();
                return true;
            }
    
            // Проверяем, есть ли хотя бы одно значение из фильтра в характеристиках товара
            $filterValues = is_array($paramValues) ? $paramValues : [$paramValues];
            $productValue = $productSpecsMap[$paramKey];
            
            $hasMatch = false;
            foreach ($filterValues as $filterValue) {
                if ($this->valuesMatch($productValue, $filterValue)) {
                    $hasMatch = true;
                    break;
                }
            }
            
            if (!$hasMatch) {                
                $product->set_status_filter_false();
                return true;
            }
        }
        
        return false;
        
    }
    // Вспомогательные методы
    
    private function hasFilterParams($getParams) {
        foreach ($getParams as $key => $value) {
            if (!in_array($key, ['min_price', 'max_price', 'options']) && !empty($value)) {
                return true;
            }
        }
        return false;
    }
    
    private function prepareProductSpecs($specs) {
        $result = [];
        foreach ($specs as $spec) {
            $paramKey = $spec[2]; // rost, ves и т.д.
            $value = $spec[4];    // значение характеристики
            $result[$paramKey] = $value;
        }
        return $result;
    }
    
    private function valuesMatch($productValue, $filterValue) {
        // Приводим к строке для сравнения
        $productValue = (string)$productValue;
        $filterValue = (string)$filterValue;
        
        return $productValue === $filterValue;
    }
}