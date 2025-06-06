<?php

namespace Modules\Files\Modul;

class Service{    
   
    public function save_to_bd(\Modules\Files\Modul\File &$file){
        $data = [
            'name' => $file->get_name(),
            'type' => $file->get_type(),
            'size' => $file->get_size(),
            'path' => $file->get_path(),
            'extension' => $file->get_extension(),
            'metadata' => json_encode($file->get_metadata())
        ];

        try {
            $pdo = \Modules\Core\Modul\Sql::connect(); $stmt = $pdo->prepare("INSERT INTO  ". \Modules\Core\Modul\Env::get("DB_PREFIX") . "files (name, type, size, path, extension, metadata) 
                VALUES (:name, :type, :size, :path, :extension, :metadata)");
            $result = $stmt->execute($data);
            if ($result && $stmt->rowCount() > 0) {
                $file->set_id($pdo->lastInsertId());
                return true;
            }   
            
            $logger = new \Modules\Core\Modul\Logs();
            $logger->loging('files', "Не удалось сохранить файл: rowCount = 0");         
            return false;

        } catch (\PDOException $e) {
            $logger = new \Modules\Core\Modul\Logs();      
            $logger->loging('files', "Ошибка сохранения файла в бд");
            error_log("File save error: " . $e->getMessage());
            return false;
        }
    }

    public function generate_random_filename($length){
        $chars = 'abcdefghijklmnopqrstuvwxyz';
        $filename = '';

        for ($i = 0; $i < $length; $i++) {
            $filename .= $chars[rand(0, strlen($chars) - 1)];
        }

        return $filename;
    }

    public function save_files(){
        if($_FILES == []) return [];
        $manager = new \Modules\Files\Modul\Manager;
        $upload_dir = "upload".DS;
        return $manager->input_files_list("files", $upload_dir);
    }

}

    
