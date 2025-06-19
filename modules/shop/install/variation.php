<?php

namespace Modules\Shop\Install;

class Variation  extends \Modules\Abs\Install{

    public function install_BD(){
        $table = [];
        $table[] = '
            CREATE TABLE '.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_variation (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `product_id` bigint(20) NOT NULL,
            `external_guid` varchar(36) DEFAULT NULL,
            `external_code` varchar(100) DEFAULT NULL,
            `name` varchar(255) DEFAULT NULL,
            `price` decimal(12,2) NOT NULL,
            `old_price` decimal(12,2) DEFAULT NULL,
            `quantity` int(11) DEFAULT 0,
            `sku` varchar(100) DEFAULT NULL,
            `is_active` tinyint(1) DEFAULT 1,
            `images` text DEFAULT NULL,
            `attributes` text DEFAULT NULL,
            `sync_date` datetime DEFAULT NULL,
            `is_sync_with_1c` tinyint(1) DEFAULT 0,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_product_variations_external_guid_unique` (`external_guid`),
            UNIQUE KEY `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_product_variations_sku_unique` (`sku`),
            KEY `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_product_variations_product_id_index` (`product_id`),
            KEY `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_product_variations_external_code_index` (`external_code`),
            CONSTRAINT `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_product_variations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_product` (`id`) ON DELETE CASCADE
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