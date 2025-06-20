<?php

namespace Modules\Seo\Modul;

class Marge{
    private $list_url = [];
    private $count_add = 0;
    public function admin_router(){
        $router = \Modules\Router\Modul\Collector::get_all_routes();
        foreach($router as $name_router => $data_router){
            if ($this->is_admin_route($name_router)) {
                $this->list_url[] = $name_router;
            }
        }
        $this->add_element();
        return  $this->count_add;
    }
    
    public function default_router(){
        $router = \Modules\Router\Modul\Collector::get_all_routes();
        foreach($router as $name_router => $data_router){
            if (!($this->is_admin_route($name_router))) {
                $this->list_url[] = $name_router;
            }
        }
        $this->add_element();
        return  $this->count_add;
    }

    private function is_admin_route($route){
        return strpos($route, '/admin/') === 0;
    }

    private function add_element(){
        $pdo = \Modules\Core\Modul\Sql::connect();
        $tableName = \Modules\Core\Modul\Env::get("DB_PREFIX") . 'heads';
        foreach ($this->list_url as $item_url) {
            try {
                $stmtCheck = $pdo->prepare("
                    SELECT COUNT(*) as count 
                    FROM {$tableName} 
                    WHERE url = :url
                ");
                $stmtCheck->execute([':url' => $item_url]);
                $result = $stmtCheck->fetch(\PDO::FETCH_ASSOC);
                
                if ($result['count'] == 0) {
                    $stmtInsert = $pdo->prepare("
                        INSERT INTO {$tableName} 
                        (url, title_q, description_q, keys_q, name_q) 
                        VALUES (:url, :title, :description, :keys, :name)
                    ");
                    
                    $stmtInsert->execute([
                        ':url' => $item_url,
                        ':title' => \Modules\Core\Modul\Env::get("HEAD_TITLE_DEFAULT"),
                        ':description' => \Modules\Core\Modul\Env::get("HEAD_DESCRIPTION_DEFAULT"),
                        ':keys' => ' ',
                        ':name' => \Modules\Core\Modul\Env::get("HEAD_NAME")
                    ]);
                    $this->count_add ++;
                }
                
            } catch (\PDOException $e) {
                echo "Ошибка при работе с URL {$item_url}: " . $e->getMessage() . "\n";
                continue; // Продолжаем обработку следующих URL при ошибке
            }
        }
    }
    
}

    
