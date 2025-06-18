<?php

namespace Modules\Shop\Install;

class Catalog  extends \Modules\Abs\Install{

    public function install_BD(){
        $table = [];
        $table[] = '
        CREATE TABLE '.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_catalog (
            `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `parent_id` int(11) UNSIGNED DEFAULT NULL,
            `parent_guid` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `name_ru` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `is_active` tinyint(1) NOT NULL DEFAULT 1,
            `create_at` datetime NOT NULL DEFAULT current_timestamp(),
            `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
            `code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `external_guid` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
            `external_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `url_full` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `url_block` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `sync_date` datetime DEFAULT NULL,
            `is_sync_with_1c` tinyint(1) DEFAULT 0,
            `view_count` int(11) DEFAULT 0,
            `product_count` int(11) DEFAULT 0,
            PRIMARY KEY (`id`),
            UNIQUE KEY `idx_external_guid` (`external_guid`),
            UNIQUE KEY `idx_code` (`code`),
            UNIQUE KEY `idx_url_block` (`url_block`),
            KEY `idx_parent` (`parent_id`),
            KEY `idx_active` (`is_active`),
            KEY `idx_sync` (`is_sync_with_1c`),
            CONSTRAINT `fk_catalog_parent` FOREIGN KEY (`parent_id`) 
                REFERENCES `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_catalog` (`id`) 
                ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci';
        
        
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