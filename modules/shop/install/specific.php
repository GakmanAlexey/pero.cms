<?php

namespace Modules\Shop\Install;

class Specific  extends \Modules\Abs\Install{

    public function install_BD(){
        $table = [];
        $table[] = '
            CREATE TABLE '.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_specific_list (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `name`  varchar(255) DEFAULT NULL ,
            `name_ru`  varchar(255) DEFAULT NULL ,
            `unit` varchar(50) DEFAULT NULL ,
            `created_at` datetime NOT NULL DEFAULT current_timestamp(),
            `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
            `is_filter` tinyint(1) DEFAULT 1,
            `is_visible` tinyint(1) DEFAULT 1,
            PRIMARY KEY (`id`)
            
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ';

        
        $table[] = '
            CREATE TABLE '.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_specific_data (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
            `specific_id` bigint(20) NOT NULL,
            `product_id` bigint(20) NOT NULL,
            `varianr_id` bigint(20) NOT NULL,
            `value`  varchar(255) DEFAULT NULL ,
            `created_at` datetime NOT NULL DEFAULT current_timestamp(),
            `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
            PRIMARY KEY (`id`)
            
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