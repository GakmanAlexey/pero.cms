<?php

namespace Modules\Permission\Modul;

class Manager{
        
    public function __construct(){
       
    }

    public function permissions_list_insert($code,$description){
        $pdo = \Modules\Core\Modul\Sql::connect();   
        $checkStmt = $pdo->prepare("SELECT id FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."permissions_list WHERE code = ? LIMIT 1");
        $checkStmt->execute([$code]);
        
        if ($checkStmt->fetch()) {
            return ['success' => false, 'error' => 'Запись с таким code уже существует'];
        }

        $stmt = $pdo->prepare("INSERT INTO ".\Modules\Core\Modul\Env::get("DB_PREFIX")."permissions_list (code, description) VALUES (?, ?)");
        $result = $stmt->execute([$code,$description]);
        if ($result && $stmt->rowCount() > 0) {
                $id = $pdo->lastInsertId();
                return ['success' => true, 'id' => $id];
        }           
        return ['success' => false, 'error' => 'Ошибка при вставке данных в таблицу permissions_list'];
    }  

    

   
}