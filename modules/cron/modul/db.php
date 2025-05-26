<?php

namespace Modules\Cron\Modul;

class Db 
{
    private $task_db_file;
    private $pdo;

    public function __construct(){
        $this->task_db_file = APP_ROOT . DS. "modules" . DS . "cron" . DS . "install" . DS . 'tasksdb.json';
        $this->pdo = \Modules\Core\Modul\Sql::connect();

    }
    public function generate_json(){
        $tasks = [];
        $stmt = $this->pdo->query("
            SELECT t.id, t.name, t.task_type, t.interval_sec, t.last_run
            FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."cron_tasks t
            WHERE t.is_active = 1
        ");
        
        while ($task = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $taskId = $task['id'];
            $tasks[$taskId] = [
                'name' => $task['name'],
                'type' => $this->map_task_type($task['task_type']),
                'interval' => (int)$task['interval_sec'],
                'last_run' => $task['last_run'] ? strtotime($task['last_run']) : 0
            ];
            
            $this->add_task_params($tasks[$taskId], $taskId);
        }
        
        return file_put_contents($this->task_db_file, json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false;
    }
    private function add_task_params(array &$task, int $taskId){
        $stmt = $this->pdo->prepare("
            SELECT param_name, param_value, param_order
            FROM ".\Modules\Core\Modul\Env::get("DB_PREFIX")."cron_task_params
            WHERE task_id = ?
            ORDER BY param_order
        ");
        $stmt->execute([$taskId]);
        
        while ($param = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            switch ($param['param_name']) {
                case 'function_name':
                    $task['callable'] = $param['param_value'];
                    break;
                case 'command':
                    $task['command'] = $param['param_value'];
                    break;
                case 'class_name':
                    $task['class'] = $param['param_value'];
                    break;
                case 'method_name':
                    $task['method'] = $param['param_value'];
                    break;
                case 'args':
                    $task['args'] = json_decode($param['param_value'], true) ?: [];
                    break;
            }
        }
    }

    private function map_task_type(string $db_type){
        $map = [
            'function' => 'php_function',
            'shell' => 'shell',
            'class' => 'class_method'
        ];
        return $map[$db_type] ?? $db_type;
    }

    public function get_json_content(){
        if (!file_exists($this->task_db_file)) {
            $this->generate_json();
        }
        return json_decode(file_get_contents($this->task_db_file), true) ?: [];
    }
}