<?php

namespace Modules\Shop\Install;

class Product  extends \Modules\Abs\Install{

    public function install_BD(){
        $table = [];
        $table[] = '
            CREATE TABLE '.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_product (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `external_guid` varchar(36) DEFAULT NULL,
            `external_code` varchar(100) DEFAULT NULL,
            `article` varchar(100) DEFAULT NULL,
            `name` varchar(255) NOT NULL,
            `name_ru` varchar(255) DEFAULT NULL,
            `url_full` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `url_block` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
            `description` text DEFAULT NULL,
            `text` longtext DEFAULT NULL,
            `price` decimal(12,2) NOT NULL ,
            `old_price` decimal(12,2) DEFAULT NULL,
            `currency` varchar(3) DEFAULT \'RUB\',
            `is_active` tinyint(1) DEFAULT 1,
            `in_stock` tinyint(1) DEFAULT 0,
            `quantity` int(11) DEFAULT 0 ,
            `brand_id` bigint(20) DEFAULT NULL,
            `category_id` bigint(20) DEFAULT NULL,
            `main_image` varchar(255) DEFAULT NULL,
            `images` text DEFAULT NULL ,
            `sync_date` datetime DEFAULT NULL,
            `is_sync_with_1c` tinyint(1) DEFAULT 0,
            `sku` varchar(100) DEFAULT NULL ,
            `views_count` int(11) DEFAULT 0,
            `sales_count` int(11) DEFAULT 0,
            `barcode` varchar(50) DEFAULT NULL ,
            `width` decimal(10,2) DEFAULT NULL ,
            `height` decimal(10,2) DEFAULT NULL ,
            `length` decimal(10,2) DEFAULT NULL ,
            `weight` decimal(10,2) DEFAULT NULL ,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            `deleted_at` timestamp NULL DEFAULT NULL,
            `has_variations` tinyint(1) DEFAULT 0,
            `attributes` text DEFAULT NULL ,
            `tags` text DEFAULT NULL ,
            PRIMARY KEY (`id`),
            UNIQUE KEY `products_external_guid_unique` (`external_guid`),
            KEY `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_product_brand_id_index` (`brand_id`),
            KEY `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_product_category_id_index` (`category_id`),
            KEY `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_product_article_index` (`article`),
            KEY `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_product_external_code_index` (`external_code`),
            KEY `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_product_sku_index` (`sku`),
            KEY `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_product_barcode_index` (`barcode`)
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