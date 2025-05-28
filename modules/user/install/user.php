<?php

namespace Modules\User\Install;

class User  extends \Modules\Abs\Install{

    public function install_BD(){
        $table = [];
        $table[] = '
            CREATE TABLE '.\Modules\Core\Modul\Env::get("DB_PREFIX").'users (
            id INT(12) PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(50) UNIQUE NOT NULL, 
            email VARCHAR(100) NOT NULL,          
            password_hash VARCHAR(255) NOT NULL,
            is_active BOOLEAN DEFAULT TRUE,
            `is_banned` BOOLEAN DEFAULT FALSE,
            `ban_reason` VARCHAR(255) DEFAULT NULL,
            `ban_expiry_date` DATETIME DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )            
        ';
        $table[] = '
            CREATE TABLE '.\Modules\Core\Modul\Env::get("DB_PREFIX").'user_sessions (
            id INT(12) PRIMARY KEY AUTO_INCREMENT,
            user_id INT(12) NOT NULL,
            token TEXT NOT NULL,
            expires_at TIMESTAMP NOT NULL,
            ip_address VARCHAR(45),
            FOREIGN KEY (user_id) REFERENCES '.\Modules\Core\Modul\Env::get("DB_PREFIX").'users(id) ON DELETE CASCADE
        )            
        ';
        $table[] = '
            CREATE TABLE '.\Modules\Core\Modul\Env::get("DB_PREFIX").'password_reset_tokens (
            id INT(12) PRIMARY KEY AUTO_INCREMENT,
            user_id INT(12) NOT NULL,
            token VARCHAR(255) NOT NULL,
            expires_at TIMESTAMP NOT NULL,
            FOREIGN KEY (user_id) REFERENCES '.\Modules\Core\Modul\Env::get("DB_PREFIX").'users(id) ON DELETE CASCADE
        )            
        ';
        $table[] = '
            CREATE TABLE '.\Modules\Core\Modul\Env::get("DB_PREFIX").'user_register_token (
            id INT(12) PRIMARY KEY AUTO_INCREMENT,
            user_id INT(12) NOT NULL,
            token VARCHAR(255) NOT NULL,
            expires_at TIMESTAMP NOT NULL,
            FOREIGN KEY (user_id) REFERENCES '.\Modules\Core\Modul\Env::get("DB_PREFIX").'users(id) ON DELETE CASCADE
        )            
        ';
        $table[] = '
            CREATE INDEX idx_'.\Modules\Core\Modul\Env::get("DB_PREFIX").'users_username ON '.\Modules\Core\Modul\Env::get("DB_PREFIX").'users(username); 
            CREATE INDEX idx_'.\Modules\Core\Modul\Env::get("DB_PREFIX").'users_email ON '.\Modules\Core\Modul\Env::get("DB_PREFIX").'users(email); 
            CREATE INDEX idx_'.\Modules\Core\Modul\Env::get("DB_PREFIX").'user_sessions_user_id ON '.\Modules\Core\Modul\Env::get("DB_PREFIX").'user_sessions(user_id);
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