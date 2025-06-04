<?php

namespace Modules\Group\Modul;

class Service{
    public function create(\Modules\Group\Modul\Group $group){
       if(!$group->is_validate()) return ['success' => false, 'error' => 'Данные группы не заполнены'];
        $pdo = \Modules\Core\Modul\Sql::connect(); 

        try {
            $stmt = $pdo->prepare("
                INSERT INTO " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "groups 
                (name, name_ru, description, is_default, prefix)
                VALUES (:name, :name_ru, :description, :is_default, :prefix)
            ");
            $success = $stmt->execute([
                ':name' => $group->get_name(),
                ':name_ru' => $group->get_name_ru(),
                ':description' => $group->get_description(),
                ':is_default' => $group->get_is_default(),
                ':prefix' => $group->get_prefix()
            ]);

            if (!$success) {
                $errorInfo = $stmt->errorInfo();
                return ['success' => false,'error' => 'Ошибка при добавлении группы: ' . ($errorInfo[2] ?? 'неизвестная ошибка')];            
            }
            $newId = $pdo->lastInsertId();
            $group->set_id($newId);
            return [
                'success' => true,
                'group' => $group
            ];
        } catch (\PDOException $e) {
            return ['success' => false,'error' => 'Ошибка базы данных: ' . $e->getMessage()];
        }
    }
    public function dellete(\Modules\Group\Modul\Group $group){
        if(($group->get_name() == "") and $group->get_id() < 1) return ['success' => false, 'error' => 'Данные группы не заполнены'];
        $pdo = \Modules\Core\Modul\Sql::connect();
        try {
            $stmtDelete = $pdo->prepare("
                DELETE FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "groups 
                WHERE ((id = :id) OR (name = :name))
            ");
            $stmtDelete->execute([':id' => $group->get_id(),':name' => $group->get_name()]);
            if ($stmtDelete->rowCount() > 0) {
                return [
                    'success' => true,
                    'message' => 'Группа успешно удалена'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Группа не была удалена (неизвестная ошибка)'
                ];
            }
        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => 'Ошибка при удалении: ' . $e->getMessage()
            ];
        }
    }
    public function include(\Modules\Group\Modul\Group $group, \Modules\User\Modul\User $user){
        if($group->get_id() < 1) return ['success' => false, 'error' => 'Данные группы не заполнены'];
        if($user->get_id() < 1) return ['success' => false, 'error' => 'Данные пользователя не заполнены'];
        $pdo = \Modules\Core\Modul\Sql::connect();
        try {
            $stmtInsert = $pdo->prepare("
                INSERT INTO " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "user_groups 
                (user_id, group_id) 
                VALUES (:user_id, :group_id)
            ");
            $stmtInsert->execute([
                ':user_id' => $user->get_id(),
                ':group_id' => $group->get_id()
            ]);


            if ($stmtInsert->rowCount() > 0) {
                return [
                    'success' => true,
                    'message' => 'Пользователь успешно добавлен в группу'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Пользователь не был добавлен в группу (неизвестная ошибка)'
                ];
            }

        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => 'Ошибка при добавления пользователя в группу: ' . $e->getMessage()
            ];
        }
    }
    
    public function remove(\Modules\Group\Modul\Group $group, \Modules\User\Modul\User $user) {
        if($group->get_id() < 1) return ['success' => false, 'error' => 'Данные группы не заполнены'];
        if($user->get_id() < 1) return ['success' => false, 'error' => 'Данные пользователя не заполнены'];
        
        $pdo = \Modules\Core\Modul\Sql::connect();
        try {
            $stmtDelete = $pdo->prepare("
                DELETE FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "user_groups 
                WHERE user_id = :user_id AND group_id = :group_id
            ");
            $stmtDelete->execute([
                ':user_id' => $user->get_id(),
                ':group_id' => $group->get_id()
            ]);

            if ($stmtDelete->rowCount() > 0) {
                return [
                    'success' => true,
                    'message' => 'Пользователь успешно удален из группы'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Пользователь не был удален из группы (возможно, он не состоял в ней)'
                ];
            }
            
        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => 'Ошибка при удалении пользователя из группы: ' . $e->getMessage()
            ];
        }
    }



    public function get_data_group(\Modules\Group\Modul\Group $group){
        $pdo = \Modules\Core\Modul\Sql::connect();  
        $stmt3 = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "groups WHERE id = ? LIMIT 1");
        $stmt3->execute([$group->get_id()]);
        $group_data = $stmt3->fetch(\PDO::FETCH_ASSOC);
            $group->set_id($group_data["id"])
                ->set_name($group_data["name"])
                ->set_name_ru($group_data["name_ru"])
                ->set_description($group_data["description"])
                ->set_prefix($group_data["prefix"]);
        return $group;
    }
    
}