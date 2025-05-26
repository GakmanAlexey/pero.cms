<?php

namespace Modules\Cron\Modul;

class Builder
{
    private array $tasks = [];
    private string $modulesDir = APP_ROOT . DS . 'modules';
    private \Modules\Core\Modul\Logs $logger;

    public function __construct(){
        $this->logger = new \Modules\Core\Modul\Logs();
    }
    public function build(){
        $modules = scandir($this->modulesDir);

        foreach ($modules as $module) {
            if ($this->isInvalidModule($module)) {
                continue;
            }

            $cronFile = $this->getCronFilePath($module);
            $this->processCronFile($module, $cronFile);
        }
    }

    private function isInvalidModule(string $module){
        return $module === '.' || $module === '..' || !is_dir($this->modulesDir . DS . $module);
    }

    private function getCronFilePath(string $module){
        return $this->modulesDir . DS . $module . DS . 'install' . DS . 'cron.json';
    }

    private function processCronFile(string $moduleName, string $cronFile){
        if (!file_exists($cronFile)) {
            return;
        }

        $jsonContent = file_get_contents($cronFile);
        $tasks = json_decode($jsonContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->logger->loging('cron', "['ошибка'] JSON {$moduleName}/install/cron.json - ошибка чтения");
            return;
        }

        $this->validateAndAddTasks($tasks, $moduleName);
    }
    
    private function validateAndAddTasks(array $tasks, string $moduleName){
        foreach ($tasks as $taskId => $task) {
            if (!$this->isValidTask($task)) {
                $this->logger->loging(
                    'cron', 
                    "['ошибка'] JSON {$moduleName}/install/cron.json - неверный формат задачи #{$taskId}"
                );
                continue;
            }

            $this->tasks[$moduleName . '_' . $taskId] = [
                'id' => $moduleName . '_' . $taskId,
                'module' => $moduleName,
                'name' => $task['name'],
                'type' => $task['type'],
                'interval' => (int)$task['interval'],
                'last_run' => $task['last_run'] ?? 0,
                'data' => $this->getTaskData($task)
            ];
        }
    }

    private function isValidTask(array $task){
        $requiredFields = ['name', 'type', 'interval'];
        
        foreach ($requiredFields as $field) {
            if (!isset($task[$field])) {
                return false;
            }
        }

        return $this->validateTaskType($task);
    }
    
    private function validateTaskType(array $task){
        switch ($task['type']) {
            case 'php_function':
                return isset($task['callable']);
            case 'shell':
                return isset($task['command']);
            case 'class_method':
                return isset($task['class']) && isset($task['method']);
            default:
                return false;
        }
    }

    private function getTaskData(array $task){
        switch ($task['type']) {
            case 'php_function':
                return ['callable' => $task['callable']];
            case 'shell':
                return ['command' => $task['command']];
            case 'class_method':
                return [
                    'class' => $task['class'],
                    'method' => $task['method'],
                    'args' => $task['args'] ?? []
                ];
            default:
                return [];
        }
    }

    public function getTasks(){
        return $this->tasks;
    }

    public function saveTasksToFile(){
        $outputFile = $this->modulesDir . DS . 'cron' . DS . 'install' . DS . 'buildcronjson.json';

        $installDir = dirname($outputFile);
        if (!is_dir($installDir)) {
            mkdir($installDir, 0755, true);
        }

        $data = [
            'generated_at' => date('Y-m-d H:i:s'),
            'tasks_count' => count($this->tasks),
            'tasks' => $this->tasks
        ];

        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        if ($json === false) {
            $this->logger->loging('cron', "['ошибка'] Не удалось сгенерировать JSON для buildcronjson.json");
            return false;
        }

        $result = file_put_contents($outputFile, $json);

        if ($result === false) {
            $this->logger->loging('cron', "['ошибка'] Не удалось записать buildcronjson.json");
            return false;
        }

        return true;
    }
}