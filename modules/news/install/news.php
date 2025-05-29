<?php

namespace Modules\News\Install;

class News  extends \Modules\Abs\Install{

    public function install_BD(){
        $table = [];
        $table[] = '
            CREATE TABLE '.\Modules\Core\Modul\Env::get("DB_PREFIX").'news_categories (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL,
            `name_ru` varchar(255) NOT NULL,
            `url_block` varchar(100) NOT NULL,
            `full_url` varchar(255) NOT NULL,
            `main_img` varchar(255) DEFAULT NULL,
            `list_img` text DEFAULT NULL,
            `description` text DEFAULT NULL ,
            `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
            `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci           
        ';
        $table[] = '
            CREATE TABLE `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'news` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL,
            `name_ru` varchar(255) NOT NULL,
            `url_block` varchar(100) NOT NULL,
            `full_url` varchar(255) NOT NULL,
            `main_img` varchar(255) DEFAULT NULL,
            `list_img` text DEFAULT NULL,
            `description` text DEFAULT NULL,
            `text` text DEFAULT NULL,
            `category_id` int(11) NOT NULL,
            `publish_date` timestamp NOT NULL DEFAULT current_timestamp(),
            `edit_date` timestamp NULL DEFAULT NULL,
            `author_id` int(12) NOT NULL,
            `is_active` tinyint(1) NOT NULL DEFAULT 0,
            `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
            `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
            PRIMARY KEY (`id`),
            KEY `category_id` (`category_id`),
            KEY `author_id` (`author_id`),
            KEY `is_active` (`is_active`),
            CONSTRAINT `fk_news_category` FOREIGN KEY (`category_id`) 
                REFERENCES `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'news_categories` (`id`) 
                ON DELETE RESTRICT ON UPDATE CASCADE,
            CONSTRAINT `fk_news_author` FOREIGN KEY (`author_id`) 
                REFERENCES `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'users` (`id`) 
                ON DELETE RESTRICT ON UPDATE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci        
        ';
        
        return $table;
    }

    public function install_Router(){
        $table = [];



        return $table;
    }

    public function install_Congif(){
        $table = [];

        return $table;
    }
    
}