<?php

namespace Modules\Card\Modul;

class Card{    
   
    private $id;
    private $status;
    private $price;
    private $old_price;
    private $old_price;
    private $discount;
    private $shipping_price;
    private $shipping_included;
    private $commission_bank;
    private $commission_included;

    
    private $user;
    private $product_list = [];

    private $created_at;
    private $updated_at;
    private $expires_at; // время жизни корзины
    private $session_id; // для неавторизованных пользователей
    private $currency;
    private $total_weight; // общий вес товаров
    private $items_count; // количество позиций
    private $total_quantity; // общее количество товаров

    private $coupon_code;
    private $coupon_discount;
    private $tax_amount;
    private $notes;
    private $ip_address;
    private $user_agent;

    public static function create(){
       
    }
    public static function load(){
       
    }
    public static function set_product($id_product,$id_variation,$count){
       
    }
    public static function add_product($id_product,$id_variation,$count){
       
    }
    public static function add_product_count($id_product,$id_variation,$count){
       
    }
    public static function remove_product($id_product,$id_variation,$count){
       
    }
    public static function remove_product_count($id_product,$id_variation,$count){
       
    }
    
    public static function update_card(){
       
    }
    
    public static function show_conut(){
       
    }
    
    public static function show_prise(){
       
    }

    
}

    
