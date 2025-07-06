<?php

namespace Modules\Shop\Modul;

class Specificservice{
   
    public function show_all(){
        $specific_list = [];

        $pdo = \Modules\Core\Modul\Sql::connect(); 
        $stmt = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_specific_list");
        $stmt->execute([]);
        
        while($specific_data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $specific = new \Modules\Shop\Modul\Specificone();
            $specific->set_id($specific_data["id"])
                ->set_name($specific_data["name"])
                ->set_name_ru($specific_data["name_ru"])
                ->set_unit($specific_data["unit"])
                ->set_sql_is_filter($specific_data["is_filter"])
                ->set_sql_is_visible($specific_data["is_visible"]);
            
            $specific_list[] = $specific;
        }
        
        return $specific_list;
    }
    
   
    
    
}