<?php

namespace Modules\Permission\Install;

class Permission  extends \Modules\Abs\Install{

    public function install_BD(){
        $table = [];
        $table[] = '
            CREATE TABLE '.\Modules\Core\Modul\Env::get("DB_PREFIX").'permissions_list (
            id INT(12) PRIMARY KEY AUTO_INCREMENT,
            code VARCHAR(255) NOT NULL UNIQUE, 
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )        
        ';
        $table[] = '
            CREATE TABLE '.\Modules\Core\Modul\Env::get("DB_PREFIX").'permissions_group (
            id INT(12) PRIMARY KEY AUTO_INCREMENT,
            group_id INT(12) NOT NULL,
            permission_id INT(12) NOT NULL
            )
        ';
        $table[] = '
            CREATE TABLE '.\Modules\Core\Modul\Env::get("DB_PREFIX").'permissions_user (
            id INT(12) PRIMARY KEY AUTO_INCREMENT,
            user_id INT(12) NOT NULL,
            permission_id INT(12) NOT NULL
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