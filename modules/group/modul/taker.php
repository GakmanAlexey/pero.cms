<?php

namespace Modules\Group\Modul;

class Taker{
    public $group_array = [];
    public function get_from_user(\Modules\User\Modul\User $user){
        $gp = new \Modules\Group\Modul\Group;
        if($user->get_id() == 0){
            $gp->set_id(0);
            return $gp;
        }
        $pdo = \Modules\Core\Modul\Sql::connect(); 

        $stmt2 = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "user_groups WHERE user_id = ? LIMIT 1");
        $stmt2->execute([$user->get_id()]);
        $gp_data = $stmt2->fetch(\PDO::FETCH_ASSOC);

        if (!$gp_data) {
            $gp->set_id(0);
        }else{
            $stmt3 = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "groups WHERE id = ? LIMIT 1");
            $stmt3->execute([$gp_data["group_id"]]);
            $group_data = $stmt3->fetch(\PDO::FETCH_ASSOC);
            if (!$group_data) {
                $gp->set_id(0);
                $gp->set_prefix([]);
            }else{
                $gp->set_id($group_data["id"])
                    ->set_name($group_data["name"])
                    ->set_name_ru($group_data["name_ru"])
                    ->set_prefix($group_data["prefix"]);
            }
        }
        return $gp;
    }

    public function get_all_groups(){
        $pdo = \Modules\Core\Modul\Sql::connect(); 
        $stmt2 = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "groups ");
        $stmt2->execute([]);
        while($group_data = $stmt2->fetch(\PDO::FETCH_ASSOC)){
            $group = new \Modules\Group\Modul\Group();
            $group->set_id($group_data["id"])
                ->set_name($group_data["name"])
                ->set_name_ru($group_data["name_ru"])
                ->set_description($group_data["description"])
                ->set_prefix($group_data["prefix"]);
            $this->group_array[] = $group;
        }
        return $this->group_array;
    }

    public function get_data_group(){
        if(isset($_GET["id"]) and ($_GET["id"] >= 1)){
            $service = new \Modules\Group\Modul\Service;
            $group = new \Modules\Group\Modul\Group();
            $group->set_id($_GET["id"]);
            return $service->get_data_group($group);
        }
    }


    public function save_edit_admin(){
        if(isset($_POST["save_boot_gp"]) and $_POST["save_boot_gp"]=="save"){
            if(!isset($_POST["name_ru"])){
                return [
                    'success' => false,
                    'msg' => "Имя группы на русском не может быть пустым"
                ];
            }
            if(!isset($_POST["name"])){
                return [
                    'success' => false,
                    'msg' => "Системное имя не может быть пустым"
                ];
            }
            if(!isset($_POST["prefix"])){
                return [
                    'success' => false,
                    'msg' => "Префикс не может быть пустым"
                ];
            }
            if(!isset($_POST["discription"])){
                return [
                    'success' => false,
                    'msg' => "Описание не может быть пустым"
                ];
            }
            $pdo = \Modules\Core\Modul\Sql::connect();  
            $stmt = $pdo->prepare("UPDATE " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "groups
                            SET name = ?,  name_ru = ?, description = ?,  prefix = ?
                            WHERE id = ?");
            $result = $stmt->execute([$_POST["name"],$_POST["name_ru"], $_POST["discription"],$_POST["prefix"],$_GET["id"]]);  
                return [
                    'success' => true,
                    'msg' => "сохранения изменены"
                ];      
        }
        return [];
    }
    
}