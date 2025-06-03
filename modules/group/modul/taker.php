<?php

namespace Modules\Group\Modul;

class Taker{
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
    
}