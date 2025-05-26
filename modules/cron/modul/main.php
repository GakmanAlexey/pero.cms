<?php

namespace Modules\Cron\Modul;

class Mian 
{
    private $task_file;

    public function __construct(){
        $this->task_file = APP_ROOT . DS. "modules" . DS . "cron" . DS . "install" . DS . 'tasks.json';
        if (!file_exists($this->task_file)) {
            $this->build();
        }
    }
    public function build(){
        file_put_contents($this->task_file, json_encode([], JSON_PRETTY_PRINT));
    }

    public function start(){
        $tasks = $this->load_tasks();
        $this->process_tasks($tasks);
    }

    private function load_tasks(){
        $json = file_get_contents($this->task_file);
        return json_decode($json, true) ?: [];
    }

    private function process_tasks(array $tasks){
        $updated = false; 
        
        foreach ($tasks as $task_id => &$task) {
            if ($this->should_run($task)) {
                $this->run_task($task_id, $task);
                $task['last_run'] = time(); 
                $updated = true;
            }
        }
        
        if ($updated) {
            file_put_contents($this->task_file, json_encode($tasks, JSON_PRETTY_PRINT));
        }
    }

    private function should_run(array $task){
        $now = time();
        $last_run = $task['last_run'] ?? 0;
        return ($now - $last_run) >= ($task['interval'] ?? 60);
    }

    private function run_task(int $task_id, array $task){
        $logger = new \Modules\Core\Modul\Logs();
        
        try {
            switch ($task['type']) {
                case 'php_function':
                    $result = $this->execute_php_function($task['callable']);
                    break;
                
                case 'shell':
                    $result = shell_exec($task['command']);
                    break;
                
                case 'class_method':
                    $class = $task['class'];
                    $method = $task['method'];
                    $args = $task['args'] ?? [];
                    $result = $this->execute_class_method($class, $method, $args);
                    break;
                
                default:
                    $logger->loging('cron', "['ошибка'] неизвестный тип команды: " . $task['type']);
                    throw new \Exception("Unknown task type: {$task['type']}");
            }
            
            $logger->loging('cron', "['успех'] задача #{$task_id} выполнена: " . $task['name']);
            return $result;
            
        } catch (\Exception $e) {
            $logger->loging('cron', "['ошибка'] задача #{$task_id} не выполнена: " . $e->getMessage());
            throw $e;
        }

        
    }
    private function execute_class_method(string $class, string $method, array $args = []){
        $logger = new \Modules\Core\Modul\Logs();   
        if (!class_exists($class)) {
            $logger->loging('cron', "['ошибка'] неизвестный класс: " . $class);
            throw new \Exception("Class {$class} not found");
        }
        
        $instance = new $class();
        
        if (!method_exists($instance, $method)) {
            $logger->loging('cron', "['ошибка'] неизвестная функция класса" . $class . " " . $method);
            throw new \Exception("Method {$method} not found in {$class}");
        }
        
        return call_user_func_array([$instance, $method], $args);
    }

    private function execute_php_function(string $function){
        if (function_exists($function)) {
            return call_user_func($function);
        }
        $logger = new \Modules\Core\Modul\Logs();     
        $logger->loging('cron', "['ошибка'] неизвестный php функция: " . $function);
        throw new \Exception("PHP function {$function} not found");
    }
}