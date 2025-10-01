<?php

namespace Modules\Shop\Modul;

class Product{
    private $id;
    private $external_guid;
    private $external_code;
    private $article;
    private $name;
    private $name_ru;
    private $description;
    private $text;
    private $price;
    private $old_price;
    private $currency;
    private $is_active;
    private $in_stock;
    private $quantity;
    private $brand_id;
    private $category_id;
    private $main_image;
    private $url_full;
    private $url_block;
    private $images = [];
    private $sync_date;
    private $is_sync_with_1c;
    private $sku;
    private $views_count;           // Количество просмотров
    private $sales_count;           // Количество продаж
    private $barcode;               // Штрих-код
    private $width;                 // Ширина
    private $height;                // Высота
    private $length;                // Длина
    private $weight;                // Вес
    private $created_at;            // Дата создания
    private $updated_at;            // Дата обновления
    private $deleted_at;            // Дата удаления (soft delete)

    private $has_variations = false;
    private $variations = [];
    private $attributes = [];
    private $tags = [];
    private $specific;

    private $status_filter = true;
    
    private $count_buy_in_card = 0;
    public function get_count_buy_in_card(){
        return $this->count_buy_in_card;
    }
    public function set_count_buy_in_card($count){
        $this->count_buy_in_card = $count;
        return $this;
    }
    public function get_id() {
        return $this->id;
    }
    public function set_id($id) {
        $this->id = $id;
        return $this;
    }

    public function get_external_guid() {
        return $this->external_guid;
    }
    public function set_external_guid($external_guid) {
        $this->external_guid = substr($external_guid, 0, 36);
        return $this;
    }

    public function get_external_code() {
        return $this->external_code;
    }
    public function set_external_code($external_code) {
        $this->external_code = $external_code;
        return $this;
    }

    public function get_article() {
        return $this->article;
    }
    public function set_article($article) {
        $this->article = $article;
        return $this;
    }

    public function get_name() {
        return $this->name;
    }
    public function set_name($name) {
        $this->name = $name;
        return $this;
    }

    public function get_name_ru() {
        return $this->name_ru;
    }
    public function set_name_ru($name_ru) {
        $this->name_ru = $name_ru;
        return $this;
    }

    public function set_url_full($url_full){
        $this->url_full = $url_full;
        return $this;
    }
    public function get_url_full(){
        return $this->url_full;
    }

    public function set_url_block($url_block){
        $this->url_block = $url_block;
        return $this;
    }
    public function get_url_block(){
        return $this->url_block;
    }

    public function get_description() {
        return $this->description;
    }
    public function set_description($description) {
        $this->description = $description;
        return $this;
    }

    public function get_text() {
        return $this->text;
    }
    public function set_text($text) {
        $this->text = $text;
        return $this;
    }

    public function get_price() {
        return number_format((float)$this->price, 2, '.', '');
    }
    public function set_price($price) {
        $this->price = $price;
        return $this;
    }

    public function get_old_price() {
        return $this->old_price === null ? null : (float)$this->old_price;
    }
    public function set_old_price($old_price) {
        $this->old_price = $old_price;
        return $this;
    }

    public function get_currency() {
        return $this->currency;
    }
    public function set_currency($currency) {
        $this->currency = $currency;
        return $this;
    }

    public function get_is_active() {
        return $this->is_active;
    }
    public function set_is_active($is_active) {
        $this->is_active = $is_active;
        return $this;
    }

    public function get_in_stock() {
        return $this->in_stock;
    }
    public function set_in_stock($in_stock) {
        $this->in_stock = $in_stock;
        return $this;
    }

    public function get_quantity() {
        return $this->quantity;
    }
    public function set_quantity($quantity) {
        $this->quantity = $quantity;
        return $this;
    }

    public function get_brand_id() {
        return $this->brand_id;
    }
    public function set_brand_id($brand_id) {
        $this->brand_id = $brand_id;
        return $this;
    }

    public function get_category_id() {
        return $this->category_id;
    }
    public function set_category_id($category_id) {
        $this->category_id = $category_id;
        return $this;
    }

    public function get_main_image() {
        return $this->main_image;
    }
    public function set_main_image($main_image) {
        $this->main_image = $main_image;
        return $this;
    }

    public function get_images() {
        return $this->images;
    }

    public function get_images_str() {

        return serialize($this->images);
    }
    public function set_images(array $images) {
        $this->images = $images;
        return $this;
    }
    public function add_image($image) {
        $this->images[] = $image;
        return $this;
    }

    public function get_sync_date() {
        return $this->sync_date;
    }
    public function set_sync_date($sync_date) {
        $this->sync_date = $sync_date;
        return $this;
    }

    public function get_is_sync_with_1c() {
        return $this->is_sync_with_1c;
    }
    public function set_is_sync_with_1c($is_sync_with_1c) {
        $this->is_sync_with_1c = $is_sync_with_1c;
        return $this;
    }

    public function get_has_variations() {
        if($this->has_variations) return 1;
        return 0;
    }
    public function set_has_variations($has_variations) {
        $this->has_variations = $has_variations;
        return $this;
    }

    public function get_variations() {
        return $this->variations;
    }
    public function set_variations(array $variations) {
        $this->variations = $variations;
        $this->has_variations = !empty($variations);
        return $this;
    }
    public function add_variation(\Modules\Shop\Modul\Variation $variation) {
        $this->variations[] = $variation;
        $this->has_variations = true;
        return $this;
    }

    public function get_attributes() {
        return $this->attributes;
    }
    public function set_attributes(array $attributes) {
        $this->attributes = $attributes;
        return $this;
    }
    public function add_attribute($name, $value) {
        $this->attributes[$name] = $value;
        return $this;
    }

    public function get_tags() {
        return $this->tags;
    }
    public function set_tags(array $tags) {
        $this->tags = $tags;
        return $this;
    }
    public function add_tag($tag) {
        $this->tags[] = $tag;
        return $this;
    }

    public function get_sku() {
        return $this->sku;
    }
    public function set_sku($sku) {
        $this->sku = $sku;
        return $this;
    }
    
    public function get_views_count() {
        return $this->views_count;
    }
    public function set_views_count($count) {
        $this->views_count = $count;
        return $this;
    }
        
    public function get_sales_count() {
        return $this->sales_count;
    }
    public function set_sales_count($count) {
        $this->sales_count = $count;
        return $this;
    }
        
    public function get_barcode() {
        return $this->barcode;
    }
    public function set_barcode($barcode) {
        $this->barcode = $barcode;
        return $this;
    }
        
    public function get_width() {
        return $this->width;
    }
    public function set_width($width) {
        $this->width = $width;
        return $this;
    }
        
    public function get_height() {
        return $this->height;
    }
    public function set_height($height) {
        $this->height = $height;
        return $this;
    }
        
    public function get_length() {
        return $this->length;
    }
    public function set_length($length) {
        $this->length = $length;
        return $this;
    }
        
    public function get_weight() {
        return $this->weight;
    }
    public function set_weight($weight) {
        $this->weight = $weight;
        return $this;
    }
        
    public function get_created_at() {
        return $this->created_at;
    }
    public function set_created_at($created_at) {
        $this->created_at = $created_at;
        return $this;
    }
        
    public function get_updated_at() {
        return $this->updated_at;
    }
    public function set_updated_at($updated_at) {
        $this->updated_at = $updated_at;
        return $this;
    }
        
    public function get_deleted_at() {
        return $this->deleted_at;
    }
    public function set_deleted_at($deleted_at) {
        $this->deleted_at = $deleted_at;
        return $this;
    }
        
    public function get_specific() {
        return $this->specific;
    }
    public function set_specific($specific) {
        $this->specific = $specific;
        return $this;
    }

    public function set_status_filter_true(){
        $this->status_filter = true;
        return $this;
    }
    
    public function set_status_filter_false(){
        $this->status_filter = false;
        return $this;        
    }

    public function get_status_filter(){
        return $this->status_filter;
    }

}

    