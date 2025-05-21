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
    public function include(){
       
    }
    public function remove(){
       
    }
    
}