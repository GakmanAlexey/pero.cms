<?php

namespace Modules\Group\Install;

class Group  extends \Modules\Abs\Install{

    public function install_BD(){
        $table = [];
        $table[] = '
            CREATE TABLE '.\Modules\Core\Modul\Env::get("DB_PREFIX").'groups (
            `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(50) NOT NULL,
            `name_ru` VARCHAR(50) NOT NULL,
            `description` TEXT NULL,
            `is_default` TINYINT(1) DEFAULT 0,
            `prefix` VARCHAR(50) NOT NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `name_unique` (`name`)
            )        
        ';
        $table[] = '
            CREATE TABLE '.\Modules\Core\Modul\Env::get("DB_PREFIX").'user_groups (
            `id` INT(12) UNSIGNED NOT NULL AUTO_INCREMENT,
            `user_id` INT(12)  NOT NULL,
            `group_id` INT(12) UNSIGNED NOT NULL,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`user_id`) REFERENCES `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'users` (`id`) ON DELETE CASCADE,
            FOREIGN KEY (`group_id`) REFERENCES `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'groups` (`id`) ON DELETE CASCADE
            )
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