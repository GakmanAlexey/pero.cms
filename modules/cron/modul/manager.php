<?php

namespace Modules\Cron\Modul;

class Manager
{
    private string $modulesDir;
    private \Modules\Core\Modul\Logs $logger;

    public function __construct(){
        $this->modulesDir = APP_ROOT . DS . 'modules';
        $this->logger = new \Modules\Core\Modul\Logs();
    }

    public function buildAndMerge(){
        try {

            $builder = new Builder();
            $builder->build();
            $builder->saveTasksToFile();
            $jsonTasks = $builder->getTasks();

            $db = new Db();
            $db->generate_json();
            $dbTasks = $db->get_json_content();

            $mergedTasks = $this->mergeTasks($jsonTasks, $dbTasks);

            return $this->saveMergedTasks($mergedTasks);
        } catch (\Exception $e) {
            $this->logger->loging('cron', "['ошибка'] Ошибка при объединении задач: " . $e->getMessage());
            return false;
        }
    }

    private function mergeTasks(array $jsonTasks, array $dbTasks){
        $merged = [];

        foreach ($jsonTasks as $taskId => $task) {
            $merged[$taskId] = $this->prepareTask($task, 'module');
        }

        foreach ($dbTasks as $taskId => $task) {
            $merged['db_' . $taskId] = $this->prepareTask($task, 'database');
        }

        return $merged;
    }

    private function prepareTask(array $task, string $source){
        $baseTask = [
            'name' => $task['name'] ?? 'Без названия',
            'type' => $task['type'],
            'interval' => (int)($task['interval'] ?? 0),
            'last_run' => $task['last_run'] ?? 0,
            'source' => $source
        ];

        if (isset($task['data'])) {
            return array_merge($baseTask, $task['data']);
        } else {
            $typeSpecific = [
                'php_function' => ['callable' => $task['callable'] ?? ''],
                'shell' => ['command' => $task['command'] ?? ''],
                'class_method' => [
                    'class' => $task['class'] ?? '',
                    'method' => $task['method'] ?? '',
                    'args' => $task['args'] ?? []
                ]
            ];
            
            return array_merge($baseTask, $typeSpecific[$task['type']] ?? []);
        }
    }

    private function saveMergedTasks(array $tasks){
        $outputFile = $this->modulesDir . DS . 'cron' . DS . 'install' . DS . 'tasks.json';
        
        $data = [
            'generated_at' => date('Y-m-d H:i:s'),
            'tasks_count' => count($tasks),
            'tasks' => $tasks
        ];

        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        if ($json === false) {
            $this->logger->loging('cron', "['ошибка'] Не удалось сгенерировать JSON для tasks.json");
            return false;
        }

        $result = file_put_contents($outputFile, $json);

        if ($result === false) {
            $this->logger->loging('cron', "['ошибка'] Не удалось записать tasks.json");
            return false;
        }

        return true;
    }
}