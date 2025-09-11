<?php

namespace Modules\Card\Install;

class Card  extends \Modules\Abs\Install{

    public function install_BD(){
        $table = [];
        $table[] = 'CREATE TABLE `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'shop_card` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `status` varchar(20) NOT NULL DEFAULT \'active\',
        `price` decimal(12,2) NOT NULL DEFAULT 0.00,
        `old_price` decimal(12,2) NOT NULL DEFAULT 0.00,
        `discount` decimal(12,2) NOT NULL DEFAULT 0.00,
        `shipping_price` decimal(12,2) NOT NULL DEFAULT 0.00,
        `shipping_included` tinyint(1) NOT NULL DEFAULT 0,
        `commission_bank` decimal(12,2) NOT NULL DEFAULT 0.00,
        `commission_included` tinyint(1) NOT NULL DEFAULT 0,
        
        `user_id` int(11) DEFAULT NULL, 
        `guest_id` varchar(40) DEFAULT NULL, 
        `product_list` text DEFAULT NULL,
        
        `created_at` datetime NOT NULL DEFAULT current_timestamp(),
        `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
        `expires_at` datetime DEFAULT NULL,
        `session_id` varchar(255) DEFAULT NULL,
        `currency` varchar(3) NOT NULL DEFAULT \'RUB\',
        `total_weight` decimal(10,3) NOT NULL DEFAULT 0.000,
        `items_count` int(11) NOT NULL DEFAULT 0,
        `total_quantity` int(11) NOT NULL DEFAULT 0,

        `coupon_code` varchar(50) DEFAULT NULL,
        `coupon_discount` decimal(12,2) NOT NULL DEFAULT 0.00,
        `tax_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
        `notes` text DEFAULT NULL,
        `ip_address` varchar(45) DEFAULT NULL,
        `user_agent` varchar(255) DEFAULT NULL,
        
        `delivery_type` varchar(50) DEFAULT NULL,
        `payment_method` varchar(50) DEFAULT NULL,
        `delivery_address` text DEFAULT NULL,
        `contact_phone` varchar(20) DEFAULT NULL,
        `contact_email` varchar(255) DEFAULT NULL,

        PRIMARY KEY (`id`),
        KEY `user_id` (`user_id`),
        KEY `session_id` (`session_id`),
        KEY `status` (`status`),
        KEY `expires_at` (`expires_at`),
        KEY `created_at` (`created_at`)
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