<?php

namespace Modules\Card\Modul;

class Card{    
   
    private $id;
    private $status;
    private $price;
    private $old_price;
    private $discount;
    private $shipping_price;
    private $shipping_included;
    private $commission_bank;
    private $commission_included;

    
    private $user;
    private $guest;
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

    public function set_id($id){
        $this->id = $id;
        return $this;
    }
    
    public function get_id(){
        return $this->id;
    }


    public function set_user($id_user){
        $this->user = $id_user;
        return $this;
    }
    
    public function get_user(){
        return $this->user;
    }

    public function set_guest($id_guest){
        $this->guest = $id_guest;
        return $this;
    }
    
    public function get_guest(){
        return $this->guest;
    }

    public function set_status($status){
        $this->status = $status;
        return $this;
    }
    
    public function get_status(){
        return $this->status;
    }
    
    public function set_price($price){
        $this->price = $price;
        return $this;
    }
    
    public function get_price(){
        return $this->price;
    }
    
    public function set_old_price($old_price){
        $this->old_price = $old_price;
        return $this;
    }
    
    public function get_old_price(){
        return $this->old_price;
    }
    
    public function set_discount($discount){
        $this->discount = $discount;
        return $this;
    }
    
    public function get_discount(){
        return $this->discount;
    }
    
    public function set_shipping_price($shipping_price){
        $this->shipping_price = $shipping_price;
        return $this;
    }
    
    public function get_shipping_price(){
        return $this->shipping_price;
    }
    
    public function set_shipping_included($shipping_included){
        $this->shipping_included = $shipping_included;
        return $this;
    }
    
    public function get_shipping_included(){
        return $this->shipping_included;
    }
    
    public function set_commission_bank($commission_bank){
        $this->commission_bank = $commission_bank;
        return $this;
    }
    
    public function get_commission_bank(){
        return $this->commission_bank;
    }
    
    public function set_commission_included($commission_included){
        $this->commission_included = $commission_included;
        return $this;
    }
    
    public function get_commission_included(){
        return $this->commission_included;
    }
    
    public function set_product_list($product_list){
        $this->product_list = $product_list;
        return $this;
    }
    
    public function get_product_list(){
        return $this->product_list;
    }
    public function add_product_list($product){
        $this->product_list[] = $product;
        return $this;
    }
    
    public function set_created_at($created_at){
        $this->created_at = $created_at;
        return $this;
    }
    
    public function get_created_at(){
        return $this->created_at;
    }
    
    public function set_updated_at($updated_at){
        $this->updated_at = $updated_at;
        return $this;
    }
    
    public function get_updated_at(){
        return $this->updated_at;
    }
    
    public function set_expires_at($expires_at){
        $this->expires_at = $expires_at;
        return $this;
    }
    
    public function get_expires_at(){
        return $this->expires_at;
    }
    
    public function set_session_id($session_id){
        $this->session_id = $session_id;
        return $this;
    }
    
    public function get_session_id(){
        return $this->session_id;
    }
    
    public function set_currency($currency){
        $this->currency = $currency;
        return $this;
    }
    
    public function get_currency(){
        if (empty($this->currency)) {
            $this->currency = "RUB"; // или ваша валюта по умолчанию
        }
        return $this->currency;
    }
    
    public function set_total_weight($total_weight){
        $this->total_weight = $total_weight;
        return $this;
    }
    
    public function get_total_weight(){
        if (empty($this->total_weight) && $this->total_weight !== 0) {
            $this->total_weight = 0.000; // значение по умолчанию как в БД
        }
        return $this->total_weight;
    }
    
    public function set_items_count($items_count){
        $this->items_count = $items_count;
        return $this;
    }
    
    public function get_items_count(){
        if ($this->items_count === null || $this->items_count === '') {
            $this->items_count = 0;
        }
        return $this->items_count;
    }
    
    public function set_total_quantity($total_quantity){
        $this->total_quantity = $total_quantity;
        return $this;
    }
    
    public function get_total_quantity(){
        if ($this->total_quantity === null || $this->total_quantity === '') {
            $this->total_quantity = 0;
        }
        return $this->total_quantity;
    }
    
    public function set_coupon_code($coupon_code){
        $this->coupon_code = $coupon_code;
        return $this;
    }
    
    public function get_coupon_code(){
        return $this->coupon_code;
    }
    
    public function set_coupon_discount($coupon_discount){
        $this->coupon_discount = $coupon_discount;
        return $this;
    }
    
    public function get_coupon_discount(){
        if ($this->coupon_discount === null || $this->coupon_discount === '') {
            $this->coupon_discount = 0.00;
        }
        return (float)$this->coupon_discount;
    }
    
    public function set_tax_amount($tax_amount){
        $this->tax_amount = $tax_amount;
        return $this;
    }
    
    public function get_tax_amount(){
        if ($this->tax_amount === null || $this->tax_amount === '') {
            $this->tax_amount = 0.00;
        }
        return (float)$this->tax_amount;
    }
    
    public function set_notes($notes){
        $this->notes = $notes;
        return $this;
    }
    
    public function get_notes(){
        return $this->notes;
    }
    
    public function set_ip_address($ip_address){
        $this->ip_address = $ip_address;
        return $this;
    }
    
    public function get_ip_address(){
        return $this->ip_address;
    }
    
    public function set_user_agent($user_agent){
        $this->user_agent = $user_agent;
        return $this;
    }
    
    public function get_user_agent(){
        return $this->user_agent;
    }
/*
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
*/
    
}

    
