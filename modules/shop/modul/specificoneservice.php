<?php

namespace Modules\Shop\Modul;

class Specificoneservice{
   
    public function create(){
        if(!isset($_POST["save_boot_new_spec"])){
            return [
                'job' => false,
                'result' => true,
                'id' => 0,
                'msg' => "Работа не запущена"
            ];
        }
        if(!isset($_POST["name"])){
            return [
                'job' => true,
                'result' => false,
                'id' => 0,
                'msg' => "Заполните все поля"
            ];
        }
        if(!isset($_POST["unit"])){
            return [
                'job' => true,
                'result' => false,
                'id' => 0,
                'msg' => "Заполните все поля"
            ];
        }

        $specific = $this->pre_job();
        return $this->set_sql($specific);
    }
    
    public function pre_job(){
        $so = new \Modules\Shop\Modul\Specificone;
        $so->set_name_ru($_POST["name"])
            ->set_unit($_POST["unit"]);
        if(isset($_POST["card"])){
            $so->set_is_visible(true);
        }else{
            $so->set_is_visible(false);
        }
        if(isset($_POST["filter"])){
            $so->set_is_filter(true);
        }else{
            $so->set_is_filter(false);
        }
        $so->set_name(\Modules\Core\Modul\Cleanstring::sanitize($so->get_name_ru(), false, 240));
        return $so;
    }

    public function set_sql(\Modules\Shop\Modul\Specificone $specific){
        
        $pdo = \Modules\Core\Modul\Sql::connect();
        $stmt = $pdo->prepare("
            INSERT INTO ".\Modules\Core\Modul\Env::get("DB_PREFIX")."shop_specific_list 
            (name, name_ru, unit, is_filter, is_visible)
            VALUES (:name, :name_ru, :unit, :is_filter, :is_visible)
        ");
        $params = [
            ':name' =>  $specific->get_name(), 
            ':name_ru' => $specific->get_name_ru(), 
            ':unit' => $specific->get_unit(), 
            ':is_filter' => $specific->get_sql_is_filter(), 
            ':is_visible' => $specific->get_sql_is_visible()
        ];
        $stmt->execute($params);
        $specific->set_id($pdo->lastInsertId());  
        
        if( $specific->get_id() >= 1){            
            return [
                'job' => true,
                'result' => true,
                'id' =>  $specific->get_id(),
                'msg' => "Данные сохранены"
            ];
        }        
        return [
            'job' => true,
            'result' => false,
            'id' => 0,
            'msg' => "Ошибка сохранения"
        ];
    }
    
}