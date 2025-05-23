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

    public function permissions_list_delete($code) {
        $pdo = \Modules\Core\Modul\Sql::connect();

        $checkStmt = $pdo->prepare("SELECT id FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."permissions_list WHERE code = ? LIMIT 1");
        $checkStmt->execute([$code]);
        
        if (!$checkStmt->fetch()) {
            return ['success' => false, 'error' => 'Запись с таким code не найдена'];
        }

        $deleteStmt = $pdo->prepare("DELETE FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."permissions_list WHERE code = ?");
        $result = $deleteStmt->execute([$code]);
        
        if ($result && $deleteStmt->rowCount() > 0) {
            return ['success' => true];
        }    
        return ['success' => false, 'error' => 'Ошибка при удалении записи'];
    }

    public function get_id_by_code($code) {
        $pdo = \Modules\Core\Modul\Sql::connect();
        
        $stmt = $pdo->prepare("SELECT id FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."permissions_list WHERE code = ? LIMIT 1");
        $stmt->execute([$code]);
        
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return [
            'success' => (bool)$result,
            'id' => $result ? (int)$result['id'] : null,
            'error' => $result ? null : 'Запись с таким code не найдена'
        ];
    }

    public function add_permissions_to_group(\Modules\Group\Modul\Group $group, $code){
        $code_res = $this->get_id_by_code($code);
        if(!$code_res['success']) return $code_res['error'];
        $pdo = \Modules\Core\Modul\Sql::connect();

        $checkStmt = $pdo->prepare("SELECT id FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."permissions_group WHERE ((permission_id = ?) and (group_id = ?)) LIMIT 1");
        $checkStmt->execute([$code_res['id'], $group->get_id()]);
        
        if ($checkStmt->fetch()) {
            return ['success' => false, 'error' => 'Привелегия уже есть'];
        }

        $stmt = $pdo->prepare("INSERT INTO ".\Modules\Core\Modul\Env::get("DB_PREFIX")."permissions_group (permission_id, group_id) VALUES (?, ?)");
        $result = $stmt->execute([$code_res['id'], $group->get_id()]);
        if ($result && $stmt->rowCount() > 0) {
                $id = $pdo->lastInsertId();
                return ['success' => true, 'id' => $id];
        }           
        return ['success' => false, 'error' => 'Ошибка при получение данных из permissions_group'];
    }

    public function remove_permissions_from_group(\Modules\Group\Modul\Group $group, $code) {
        $code_res = $this->get_id_by_code($code);
        if(!$code_res['success']) return $code_res['error'];
        $pdo = \Modules\Core\Modul\Sql::connect();

        $checkStmt = $pdo->prepare("SELECT id FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."permissions_group WHERE ((permission_id = ?) and (group_id = ?)) LIMIT 1");
        $checkStmt->execute([$code_res['id'], $group->get_id()]);
        
        if (!$checkStmt->fetch()) {
            return ['success' => false, 'error' => 'Привилегия не найдена в группе'];
        }

        $stmt = $pdo->prepare("DELETE FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."permissions_group WHERE (permission_id = ?) AND (group_id = ?)");
        $result = $stmt->execute([$code_res['id'], $group->get_id()]);
        
        if ($result && $stmt->rowCount() > 0) {
            return ['success' => true, 'deleted' => true];
        }           
        return ['success' => false, 'error' => 'Ошибка при удалении привилегии из группы'];
    }

    public function add_permissions_to_user(\Modules\User\Modul\User $user, $code){
         $code_res = $this->get_id_by_code($code);
        if(!$code_res['success']) return $code_res['error'];
        $pdo = \Modules\Core\Modul\Sql::connect();

        $checkStmt = $pdo->prepare("SELECT id FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."permissions_user WHERE ((permission_id = ?) and (user_id = ?)) LIMIT 1");
        $checkStmt->execute([$code_res['id'], $user->get_id()]);
        
        if ($checkStmt->fetch()) {
            return ['success' => false, 'error' => 'Привелегия уже есть'];
        }

        $stmt = $pdo->prepare("INSERT INTO ".\Modules\Core\Modul\Env::get("DB_PREFIX")."permissions_user (permission_id, user_id) VALUES (?, ?)");
        $result = $stmt->execute([$code_res['id'], $user->get_id()]);
        if ($result && $stmt->rowCount() > 0) {
                $id = $pdo->lastInsertId();
                return ['success' => true, 'id' => $id];
        }           
        return ['success' => false, 'error' => 'Ошибка при получение данных из permissions_user'];
    }

    public function remove_permissions_from_user(\Modules\User\Modul\User $user, $code) {
        $code_res = $this->get_id_by_code($code);
        if(!$code_res['success']) return $code_res['error'];
        $pdo = \Modules\Core\Modul\Sql::connect();
  
        $checkStmt = $pdo->prepare("SELECT id FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."permissions_user WHERE ((permission_id = ?) and (user_id = ?)) LIMIT 1");
        $checkStmt->execute([$code_res['id'], $user->get_id()]);
        
        if (!$checkStmt->fetch()) {
            return ['success' => false, 'error' => 'Привилегия не найдена у пользователя'];
        }

        $stmt = $pdo->prepare("DELETE FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."permissions_user WHERE (permission_id = ?) AND (user_id = ?)");
        $result = $stmt->execute([$code_res['id'], $user->get_id()]);
        
        if ($result && $stmt->rowCount() > 0) {
            return ['success' => true, 'deleted' => true];
        }           
        return ['success' => false, 'error' => 'Ошибка при удалении привилегии у пользователя'];
    }

    

   
}