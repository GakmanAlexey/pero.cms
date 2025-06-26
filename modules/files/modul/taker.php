<?php

namespace Modules\Files\Modul;

class Taker{    
   
    public function get_all_files() {
        $files = [];
        try {
            $pdo = \Modules\Core\Modul\Sql::connect();
            $stmt = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "files");
            $stmt->execute();
            
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $fl = new \Modules\Files\Modul\File;
                $row['metadata'] = json_decode($row['metadata'], true);
                $row['path'] = str_replace(APP_ROOT, '', $row['path']);
                $fl->set_id($row['id'])
                    ->set_name($row['name'])
                    ->set_type($row['type'])
                    ->set_size($row['size'])
                    ->set_path($row['path'])
                    ->set_extension($row['extension'])
                    ->set_metadata($row['metadata']);
                $files[] = $fl;
            };            
            return $files;
            
        } catch (\PDOException $e) {
            $logger = new \Modules\Core\Modul\Logs();      
            $logger->loging('files', "Ошибка получения списка файлов из бд");
            error_log("Files fetch error: " . $e->getMessage());
            return [];
        }
    }

    public static function take($id){
        $pdo = \Modules\Core\Modul\Sql::connect();
        $stmt = $pdo->prepare("SELECT * FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "files WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        $fl = new \Modules\Files\Modul\File;
        if(isset($row["id"])){
            $row['metadata'] = json_decode($row['metadata'], true);
            $row['path'] = str_replace(APP_ROOT, '', $row['path']);
            $fl->set_id($row['id'])
                ->set_name($row['name'])
                ->set_type($row['type'])
                ->set_size($row['size'])
                ->set_path($row['path'])
                ->set_extension($row['extension'])
                ->set_metadata($row['metadata']);
        }
        return $fl;
    }

    
}

    
