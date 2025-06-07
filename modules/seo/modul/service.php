<?php

namespace Modules\Seo\Modul;

class Service{
    private \Modules\Seo\Modul\Page $page;
    private \PDO $pdo;
    private string $table_name;

    public function __construct(){
        $this->pdo = \Modules\Core\Modul\Sql::connect();
        $this->table_name = \Modules\Core\Modul\Env::get("DB_PREFIX") . "heads";
    }

    public function target(\Modules\Seo\Modul\Page $page){
        $this->page = $page;
        return $this;
    }

    public function insert(){    
        try {
            $checkStmt = $this->pdo->prepare("
                SELECT COUNT(*) as count 
                FROM {$this->table_name} 
                WHERE url = :url
            ");
            $checkStmt->execute([':url' => $this->page->get_url()]);
            $result = $checkStmt->fetch(\PDO::FETCH_ASSOC);

            if ($result['count'] > 0) {
                $this->log_error("Запись с URL '{$this->page->get_url()}' уже существует");
                return false;
            }

            $stmt = $this->pdo->prepare("
                INSERT INTO {$this->table_name} 
                (url, title_q, description_q, keys_q, name_q) 
                VALUES (:url, :title, :description, :keys, :name)
            ");

            return $stmt->execute([
                ':url' => $this->page->get_url(),
                ':title' => $this->page->get_title(),
                ':description' => $this->page->get_description(),
                ':keys' => $this->page->get_keys(),
                ':name' => $this->page->get_name()
            ]);

        } catch (\PDOException $e) {
            $this->log_error("Ошибка вставки: " . $e->getMessage());
            return false;
        }
    }

    public function update(){
        try {
            $stmt = $this->pdo->prepare("
                UPDATE {$this->table_name} 
                SET 
                    url = :url,
                    title_q = :title,
                    description_q = :description,
                    keys_q = :keys,
                    name_q = :name
                WHERE id = :id
            ");

            return $stmt->execute([
                ':id' => $this->page->get_id(),
                ':url' => $this->page->get_url(),
                ':title' => $this->page->get_title(),
                ':description' => $this->page->get_description(),
                ':keys' => $this->page->get_keys(),
                ':name' => $this->page->get_name()
            ]);

        } catch (\PDOException $e) {
            $this->log_error("Ошибка обновления ID {$this->page->get_id()}: " . $e->getMessage());
            return false;
        }
    }
    
    public function delete(){
        try {
            $stmt = $this->pdo->prepare("
                DELETE FROM {$this->table_name} 
                WHERE id = :id
            ");

            return $stmt->execute([
                ':id' => $this->page->get_id()
            ]);

        } catch (\PDOException $e) {
            $this->log_error("Ошибка удаление по ID {$this->page->get_id()}: " . $e->getMessage());
            return false;
        }
    }
    public function load($url){
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM {$this->table_name} 
                WHERE url = :url 
                LIMIT 1
            ");

            $stmt->execute([':url' => $url]);
            $data = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$data) {
                return null;
            }

            return (new Page())
                ->set_id($data['id'])
                ->set_url($data['url'])
                ->set_title($data['title_q'])
                ->set_description($data['description_q'])
                ->set_keys($data['keys_q'])
                ->set_name($data['name_q']);

        } catch (\PDOException $e) {
            $this->log_error("ошибка загрузки данных по адресу {$url}: " . $e->getMessage());
            return null;
        }
    }

    private function log_error($message){
        $logger = new \Modules\Core\Modul\Logs();  
        $logger->loging('seo', $message);
    }

   

    
}

    
