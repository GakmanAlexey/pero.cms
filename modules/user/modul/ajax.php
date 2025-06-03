<?php

namespace Modules\User\Modul;

class Ajax{

    public function set_active($id){
        $user = new \Modules\User\Modul\User;
        $user->set_id($id);

        try {
            $pdo = \Modules\Core\Modul\Sql::connect();
            $stmt = $pdo->prepare("UPDATE " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "users 
                              SET is_active = 1 
                              WHERE id = ?");
            $result = $stmt->execute([$user->get_id()]);
            if ($stmt->rowCount() > 0) {                
                echo json_encode([
                    'success' => true,
                    'new_status' => 'active'
                    ]);
            } else {                
                echo json_encode([
                    'success' => false,
                    'new_status' => 'Пользователь не найден или статус уже был активен'
                    ]);
            }
             
        } catch (\PDOException $e) {              
                echo json_encode([
                    'success' => false,
                    'new_status' => 'Неизвестная ошибка'
                    ]);
        }

    }
    public function set_noactive($id){
        $user = new \Modules\User\Modul\User;
        $user->set_id($id);

        try {
            $pdo = \Modules\Core\Modul\Sql::connect();
            $stmt = $pdo->prepare("UPDATE " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "users 
                              SET is_active = 0 
                              WHERE id = ?");
            $result = $stmt->execute([$user->get_id()]);
            if ($stmt->rowCount() > 0) {                
                echo json_encode([
                    'success' => true,
                    'new_status' => 'active'
                    ]);
            } else {                
                echo json_encode([
                    'success' => false,
                    'new_status' => 'Пользователь не найден или статус уже был активен'
                    ]);
            }
             
        } catch (\PDOException $e) {              
                echo json_encode([
                    'success' => false,
                    'new_status' => 'Неизвестная ошибка'
                    ]);
        }
    }


}