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


    public function set_unban(){
        header('Content-Type: application/json');
        
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            echo json_encode(['success' => false, 'error' => 'Неверный ID пользователя']);
            exit;
        }
        
        $userId = (int)$_GET['id'];
        
        try {
            $pdo = \Modules\Core\Modul\Sql::connect();
            
            // Обновляем запись в БД
            $stmt = $pdo->prepare("UPDATE " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "users 
                                SET is_banned = 0, ban_reason = NULL, ban_expiry_date = NULL
                                WHERE id = ?");
            $stmt->execute([$userId]);
            
            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => 'Ошибка базы данных']);
        }
        exit;
    }

    public function set_ban(){
        header('Content-Type: application/json');
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            echo json_encode(['success' => false, 'error' => 'Неверный ID пользователя']);
            exit;
        }
        
        $userId = (int)$_GET['id'];
        $reason = trim($_POST['reason']);
        $expiry = $_POST['expiry'];
        
        try {
            $pdo = \Modules\Core\Modul\Sql::connect();
            $stmt = $pdo->prepare("UPDATE " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "users 
                                SET is_banned = 1, ban_reason = ?, ban_expiry_date = ?
                                WHERE id = ?");
            $stmt->execute([$reason, $expiry, $userId]);
            
            echo json_encode([
                'success' => true,
                'reason_ban' => $reason,
                'expiry_ban' => date('d.m.Y H:i', strtotime($expiry))
            ]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => 'Ошибка базы данных']);
        }
        exit;
    }


}