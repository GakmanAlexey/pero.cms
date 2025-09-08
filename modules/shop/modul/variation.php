<?php

namespace Modules\Shop\Modul;

class Variation
{
    private $id;
    private $product_id;
    private $external_guid;
    private $external_code;
    private $name;
    private $price;
    private $old_price;
    private $quantity;
    private $sku;
    private $is_active;
    private $images = [];
    private $attributes = [];
    private $sync_date;
    private $is_sync_with_1c;

    private $status_filter = true;

    // ID
    public function get_id() {
        return $this->id;
    }
    public function set_id($id) {
        $this->id = $id;
        return $this;
    }

    // Product ID
    public function get_product_id() {
        return $this->product_id;
    }
    public function set_product_id($product_id) {
        $this->product_id = $product_id;
        return $this;
    }

    // External GUID
    public function get_external_guid() {
        return $this->external_guid;
    }
    public function set_external_guid($external_guid) {
        $this->external_guid = substr($external_guid, 0, 36);
        return $this;
    }

    // External Code
    public function get_external_code() {
        return $this->external_code;
    }
    public function set_external_code($external_code) {
        $this->external_code = $external_code;
        return $this;
    }

    // Name
    public function get_name() {
        return $this->name;
    }
    public function set_name($name) {
        $this->name = $name;
        return $this;
    }

    // Price
    public function get_price() {
        return $this->price;
    }
    public function set_price($price) {
        $this->price = $price;
        return $this;
    }

    // Old Price
    public function get_old_price() {
        return $this->old_price;
    }
    public function set_old_price($old_price) {
        $this->old_price = $old_price;
        return $this;
    }

    // Quantity
    public function get_quantity() {
        return $this->quantity;
    }
    public function set_quantity($quantity) {
        $this->quantity = $quantity;
        return $this;
    }

    public function get_sku() {
        return $this->sku;
    }
    public function set_sku($sku) {
        $this->sku = $sku;
        return $this;
    }

    public function get_is_active() {
        return $this->is_active;
    }
    public function set_is_active($is_active) {
        $this->is_active = $is_active;
        return $this;
    }
    public function get_is_active_sql(){
        if($this->is_active) return 1;
        return 0;
    }

    public function get_images() {
        return $this->images;
    }
    public function set_images(array $images) {
        $this->images = $images;
        return $this;
    }

    public function get_images_str() {

        return serialize($this->images);
    }
    public function add_image($image) {
        $this->images[] = $image;
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
    public function get_attribute($name) {
        return $this->attributes[$name] ?? null;
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

    public function mark_as_synced() {
        $this->sync_date = date('Y-m-d H:i:s');
        $this->is_sync_with_1c = true;
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