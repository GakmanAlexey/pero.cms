<?php

namespace Modules\Shop\Modul;

class Productservice{
    
    public function create_new(){
        if(!isset($_POST["save_boot_new_cat"])){
            return [
                'job' => false,
                'result' => false,
                'id' => 0,
                'msg' => "Операция не зарущена"
            ];
        }

        if(!isset($_POST["category"])){
            return $this->error_add();
        }
        if(!isset($_POST["name"])){
            return $this->error_add();
        }
        if(!isset($_POST["art"])){
            return $this->error_add();
        }
        if(!isset($_POST["price"])){
            return $this->error_add();
        }
        if(!isset($_POST["old_price"])){
            return $this->error_add();
        }
        if(!isset($_POST["main_photo"])){
            return $this->error_add();
        }
        if(!isset($_POST["nomber_photo"])){
            return $this->error_add();
        }

        $product = $this->get_start_create_new();
        $product = $this->set_categor_create_new($product);
        $this->get_save_new_product($product);

    }
    public function set_categor_create_new(\Modules\Shop\Modul\Product $product){
//!!!!!!!!!!!!!!!!!!!
    }
    public function get_start_create_new(){
        $is_act = 0;
        if(isset($_POST["agree"])){
            $is_act = 1;
        }
        $product = new \Modules\Shop\Modul\Product;
        $product->set_category_id($_POST["category"])
            ->set_name_ru($_POST["name"])
            ->set_article($_POST["art"])
            ->set_price($_POST["price"])
            ->set_old_price($_POST["old_price"])
            ->set_main_image($_POST["main_photo"])
            ->get_images($_POST["nomber_photo"])
            ->set_is_active($is_act);
        return $product;
    }

    public function get_save_new_product(\Modules\Shop\Modul\Product $product){
        //!!!!!!!!!!!!!!!!!!!
    }

    public function error_add(){
        return [
            'job' => true,
            'result' => false,
            'id' => 0,
            'msg' => "Заполните все поля"
        ];
    }
}

    