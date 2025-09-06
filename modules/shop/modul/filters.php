<?php

namespace Modules\Shop\Modul;

class Filters{
    private $brand_list = [];
    private $price_list = [];
    private $param_list = [];
    private $unique_specifications = [];
    private $specification_values = [];

    public function add_brand($brand){
        foreach( $this->brand_list as $brand_item){
            if($brand_item == $brand){
                return;
            }
        }
        $this->brand_list[] = $brand;       
    }

    public function add_prise($price){

        foreach( $this->price_list as $price_item){
            if($price_item == $price){
                return;
            }
        }
        $this->price_list[] = $price;       
    }

    

    public function get_brand(){
        sort($this->brand_list);
        return  $this->brand_list;
    }
    public function get_prise(){
        sort($this->price_list);
        return  $this->price_list;
    }


    public function get_price_min() {
        if (empty($this->price_list)) {
            return null;
        }
        return min($this->price_list);
    }
    
    public function get_price_max() {
        if (empty($this->price_list)) {
            return null;
        }
        return max($this->price_list);
    }

    public function set_unique_specifications($specific) {
        $sp = $specific->get_specific();
        if (!empty($sp)) {
            foreach ($sp as $spec) {
                $param_key = $spec[2]; // Группируем по ключу (rost)
                
                // Сохраняем уникальные параметры
                if (!isset($this->unique_specifications[$param_key])) {
                    $this->unique_specifications[$param_key] = [
                        'id' => $spec[1],    // ID параметра
                        'key' => $spec[2],   // Ключ (rost)
                        'name' => $spec[3],  // Название (рост)
                        'unit' => $spec[5]   // Единица измерения (см)
                    ];
                }
                
                // Сохраняем значения для каждого параметра
                if (!isset($this->specification_values[$param_key])) {
                    $this->specification_values[$param_key] = [];
                }
                
                $value = $spec[4];
                if (!in_array($value, $this->specification_values[$param_key])) {
                    $this->specification_values[$param_key][] = $value;
                }
            }
        }
    }
    
    // Геттер для уникальных параметров
    public function get_unique_specifications() {
        return $this->unique_specifications;
    }

    // Геттер для значений параметров
    public function get_specification_values() {
        return $this->specification_values;
    }

    // Метод для сортировки значений
    public function sort_specification_values() {
        foreach ($this->specification_values as &$values) {
            if (count($values) > 0 && is_numeric($values[0])) {
                sort($values, SORT_NUMERIC);
            } else {
                sort($values);
            }
        }
    }

    // Метод для получения значений по ключу параметра
    public function get_values_by_param_key($param_key) {
        return $this->specification_values[$param_key] ?? [];
    }

    // Метод для получения параметра по ключу
    public function get_param_by_key($param_key) {
        return $this->unique_specifications[$param_key] ?? null;
    }
    
    public function load_brend_data(){
        $br_list_add = [];
        foreach($this->brand_list as $brand){
            $br = new \Modules\Shop\Modul\Brand;
            $br->set_id($brand);
            $brands_manager = new \Modules\Shop\Modul\Brandmanager;
            $br_list_add[] =$brands_manager->select($br);
        }
        $this->brand_list = $br_list_add;
    }
}