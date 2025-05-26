<?php

namespace Modules\Cron\Install;

class Cron  extends \Modules\Abs\Install{

    public function install_BD(){
        $table = [];
        $table[] = '
        CREATE TABLE '.\Modules\Core\Modul\Env::get("DB_PREFIX").'cron_tasks (
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(150) NOT NULL,
        `description` TEXT NULL DEFAULT NULL,
        `task_type` ENUM(\'function\',\'shell\',\'class\') NOT NULL,
        `is_active` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1,
        `interval_sec` INT UNSIGNED NOT NULL,
        `last_run` DATETIME(3) NULL DEFAULT NULL,
        `next_run` DATETIME NULL DEFAULT NULL,
        `timeout_sec` SMALLINT UNSIGNED DEFAULT 300,
        `max_retries` TINYINT UNSIGNED DEFAULT 3,
        `current_retries` TINYINT UNSIGNED DEFAULT 0,
        `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
        `updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`id`),
        INDEX `idx_active_next_run` (`is_active`, `next_run`),
        INDEX `idx_type_active` (`task_type`, `is_active`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;';

        $table[] = '
        CREATE TABLE '.\Modules\Core\Modul\Env::get("DB_PREFIX").'cron_task_params (
        `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
        `task_id` INT UNSIGNED NOT NULL,
        `param_name` VARCHAR(50) NOT NULL,
        `param_value` TEXT NULL DEFAULT NULL,
        `param_order` TINYINT UNSIGNED DEFAULT 0,
        `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`),
        INDEX `idx_task_id` (`task_id`),
        INDEX `idx_task_param` (`task_id`, `param_name`),
        CONSTRAINT `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'fk_task_params` FOREIGN KEY (`task_id`) 
            REFERENCES `'.\Modules\Core\Modul\Env::get("DB_PREFIX").'cron_tasks` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
        ) ENGINE=Aria DEFAULT CHARSET=utf8mb4 PAGE_CHECKSUM=1;';

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