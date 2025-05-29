<?php

namespace Modules\Router\Modul;

class Manager{
   
    public static function create($url,$class,$funct){
        $pdo = \Modules\Core\Modul\Sql::connect();
    
        try {
            $stmt = $pdo->prepare("
                INSERT INTO ".\Modules\Core\Modul\Env::get("DB_PREFIX")."router 
                (url, class, funct)
                VALUES (:url, :class, :funct)
            ");
            
            $result = $stmt->execute([
                ':url' => $url,
                ':class' => $class,
                ':funct' => $funct
            ]);
            
            if ($result) {
                return true;
            }
            
            return false;
            
        } catch (\PDOException $e) {
            error_log("Router create error: " . $e->getMessage());
            return false;
        }           
    }

   
}