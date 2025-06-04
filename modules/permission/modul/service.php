<?php

namespace Modules\Permission\Modul;

class Service{
    private $pex;
    private $pex_id = [];
    
    public function __construct(){
        $this->pex = new \Modules\Permission\Modul\Permission;
    }

    public function load_pex(\Modules\Group\Modul\Group $group, \Modules\User\Modul\User $user){
        if(isset($_SESSION["id"])) $this->load_auth();
        if(!($group->get_id() < 1)) $this->load_pex_group($group);
        if(!($user->get_id() < 1)) $this->load_pex_user($user);
        $this->id_to_pex();
        return $this->pex;
    }

    private function load_auth() {
       $this->pex->set_pex("auth");
    }

    private function load_pex_group($group) {
        $pdo = \Modules\Core\Modul\Sql::connect(); 
        $stmt = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "permissions_group WHERE group_id = ?");
        $stmt->execute([$group->get_id()]);
        while($pex_data = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $this->pex_id[] = $pex_data["permission_id"];
        }
    }

    private function load_pex_user($user) {
        $pdo = \Modules\Core\Modul\Sql::connect(); 
        $stmt = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "permissions_user WHERE user_id = ?");
        $stmt->execute([$user->get_id()]);
        while($pex_data = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $this->pex_id[] = $pex_data["permission_id"];
        }
    }

    private function id_to_pex() {
        $pdo = \Modules\Core\Modul\Sql::connect(); 
        foreach($this->pex_id as $pex_id){
            $stmt = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "permissions_list WHERE id = ? LIMIT 1");
            $stmt->execute([$pex_id]);
            $pex_data = $stmt->fetch(\PDO::FETCH_ASSOC);
            if(isset($pex_data["code"]) and $pex_data["code"]!=""){
                $this->pex->set_pex($pex_data["code"]);
            }
        }
    }


    public function get_all_pex() {
        $pex_list = [];
        $pdo = \Modules\Core\Modul\Sql::connect(); 
            $stmt = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "permissions_list ");
            $stmt->execute();
            while($pex_data = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $pex_list[] = $pex_data;
            }
        return  $pex_list;
    }

    public function get_data(){
        $pdo = \Modules\Core\Modul\Sql::connect(); 
        $stmt = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "permissions_list WHERE id = ? LIMIT 1");
        $stmt->execute([$_GET["id"]]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function get_save(){
        if(isset($_POST["save_boot_pex"]) and $_POST["save_boot_pex"]=="save"){
            if(!isset($_POST["code"])){
                return [
                    'success' => false,
                    'msg' => "КОд не может быть пустым"
                ];
            }
            if(!isset($_POST["discription"])){
                return [
                    'success' => false,
                    'msg' => "Описание не может быть пустым"
                ];
            }
            
            $pdo = \Modules\Core\Modul\Sql::connect();  
            $stmt = $pdo->prepare("UPDATE " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "permissions_list
                            SET code = ?,  description = ?
                            WHERE id = ?");
            $result = $stmt->execute([$_POST["code"],$_POST["discription"],$_GET["id"]]);  
                return [
                    'success' => true,
                    'msg' => "сохранения изменены"
                ];      
        }
        return [];
    }

   
}