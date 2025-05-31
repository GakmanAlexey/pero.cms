<?php

namespace Modules\News\Modul;

class News{
    private $id;
    private $name;
    private $name_ru;
    private $url_block;
    private $full_url;
    private $main_img;
    private $list_img = [];
    private $description;
    private $text;
    private $categor_id;
    private $publish_date;
    private $edit_date;  
    private $author; 
    private $is_active = false;
    
    public function __construct() {
        
    }

    public function set_id($id) {
        $this->id = $id;
        return $this;
    }

    public function set_categor_id($categor_id){
        $this->categor_id = $categor_id;
        return $this;
    }

    public function set_name($name) {
        $this->name = $name;
        return $this;
    }

    public function set_name_ru($name_ru) {
        $this->name_ru = $name_ru;
        return $this;
    }

    public function set_url_block($url_block) {
        $this->url_block = $url_block;
        return $this;
    }

    public function set_full_url($full_url) {
        $this->full_url = $full_url;
        return $this;
    }

    public function set_main_img($main_img) {
        $this->main_img = $main_img;
        return $this;
    }

    public function set_list_img($list_img) {
        $this->list_img = $list_img;
        return $this;
    }

    public function set_description($description) {
        $this->description = $description;
        return $this;
    }

    public function set_text($text) {
        $this->text = $text;
        return $this;
    }

    public function set_publish_date($date) {
        if (is_numeric($date)) {
            $this->publish_date = (int)$date;
        } elseif ($date instanceof \DateTime) {
            $this->publish_date = $date->getTimestamp();
        } else {
            $this->publish_date = strtotime($date);
        }
        return $this;
    }

    public function set_edit_date($date) {
        if (is_numeric($date)) {
            $this->edit_date = (int)$date;
        } elseif ($date instanceof \DateTime) {
            $this->edit_date = $date->getTimestamp();
        } else {
            $this->edit_date = strtotime($date);
        }
        return $this;
    }

    public function set_author(\Modules\User\Modul\User $user) {
        $this->author = $user;
        return $this;
    }

    public function add_to_list_img($img) {
        $this->list_img[] = $img;
        return $this;
    }

    public function activate() {
        $this->is_active = true;
        return $this;
    }

    public function deactivate() {
        $this->is_active = false;
        return $this;
    }

    public function set_active(bool $is_active) {
        $this->is_active = $is_active;
        return $this;
    }

    public function is_active(){
        return $this->is_active;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_name() {
        return $this->name;
    }

    public function get_name_ru() {
        return $this->name_ru;
    }

    public function get_url_block() {
        return $this->url_block;
    }

    public function get_full_url() {
        return $this->full_url;
    }

    public function get_main_img() {
        return $this->main_img;
    }

    public function get_list_img() {
        return $this->list_img;
    }

    public function get_description() {
        return $this->description;
    }

    public function get_text() {
        return $this->text;
    }
    
    public function get_categor_id(){
        return $this->categor_id;
    }

    public function get_publish_date($format = null) {
        if ($format && $this->publish_date) {
            return date($format, $this->publish_date);
        }
        return $this->publish_date;
    }
    public function get_publish_date_ru() {
        setlocale(LC_TIME, 'ru_RU.UTF-8');
        return strftime('%e %B %Y', $this->publish_date);
    }

    public function get_edit_date($format = null) {
        if ($format && $this->edit_date) {
            return date($format, $this->edit_date);
        }
        return $this->edit_date;
    }

    public function to_array(){
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'name_ru' => $this->name_ru,
            'url_block' => $this->url_block,
            'full_url' => $this->full_url,
            'main_img' => $this->main_img,
            'list_img' => $this->list_img,
            'description' => $this->description,
            'text' => $this->text,
            'categor_id' => $this->categor_id,
            'publish_date' => $this->publish_date,
            'edit_date' => $this->edit_date,
            'is_active' => $this->is_active,
            'publish_date_formatted' => $this->get_publish_date('Y-m-d H:i:s'),
            'edit_date_formatted' => $this->get_edit_date('Y-m-d H:i:s')
        ];

        if ($this->author instanceof \Modules\User\Modul\User) {
            $data['author'] = [
                'id' => $this->author->get_id(),
                'username' => $this->author->get_username(),
                'email' => $this->author->get_email(),
                'is_active' => $this->author->get_active()
            ];
        }

        return $data;
    }

    public function get_author(){
        $data = [
                'id' => $this->author->get_id(),
                'username' => $this->author->get_username(),
                'email' => $this->author->get_email(),
                'is_active' => $this->author->get_active()
            ];
        return $data;
    }
    
}