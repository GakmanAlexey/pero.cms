<?php

namespace Modules\Shop\Install;

class Brand  extends \Modules\Abs\Install{

    public function install_BD(){
        $table = [];
        $table[] = '
            CREATE TABLE '.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_brand (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL  ,
            `name_ru` varchar(255) DEFAULT NULL ,
            `description` text DEFAULT NULL ,
            `is_active` tinyint(1) NOT NULL DEFAULT 1 ,
            `created_at` datetime NOT NULL DEFAULT current_timestamp(),
            `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp() ,
            `code` varchar(50) DEFAULT NULL ,
            `external_guid` varchar(36) DEFAULT NULL ,
            `url_full` varchar(255) DEFAULT NULL ,
            `url_block` varchar(100) DEFAULT NULL ,
            `img` varchar(255) DEFAULT NULL ,
            `text` text DEFAULT NULL ,
            `sync_date` datetime DEFAULT NULL ,
            `is_sync_with_1c` tinyint(1) DEFAULT 0 ,
            `external_code` varchar(50) DEFAULT NULL ,
            `view_count` int(11) DEFAULT 0 ,
            `product_count` int(11) DEFAULT 0 ,
            
            PRIMARY KEY (`id`),
            UNIQUE KEY `code` (`code`),
            UNIQUE KEY `external_guid` (`external_guid`),
            UNIQUE KEY `url_block` (`url_block`),
            KEY `is_active` (`is_active`),
            KEY `is_sync_with_1c` (`is_sync_with_1c`)
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