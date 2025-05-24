<?php

namespace Modules\Abs;

abstract class Handler{
   
    private string $adress = "";

    public function handl($event_name, $data = null) {
        $events_file = $this->adress . 'events.json';
        
        if (!file_exists($events_file)) {
            $logger = new \Modules\Core\Modul\Logs();       
            $logger->loging('handler', "['ошибка'] JSON {$events_file} не найден");
            throw new \Exception("JSON {$events_file} не найден");
        }

        $json_content = file_get_contents($events_file);
        $events_config = json_decode($json_content, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            $logger = new \Modules\Core\Modul\Logs();       
            $logger->loging('handler', "['ошибка'] Ошибка парсинга JSON: " . json_last_error_msg());
            throw new \Exception("Ошибка в формате JSON: " . json_last_error_msg());
        }

        if (!isset($events_config[$event_name])) {
            $logger = new \Modules\Core\Modul\Logs();       
            $logger->loging('handler', "['ошибка'] Ивент {$event_name} не найден");
            throw new \Exception("Ивент {$event_name} не найден");
        }

        $event_config = $events_config[$event_name];
        
        if (!isset($event_config['class'])) {
            $logger = new \Modules\Core\Modul\Logs();  
            $logger->loging('handler', "['ошибка'] Не указан класс для события {$event_name}");
            throw new \Exception("Не указан класс для события {$event_name}");
        }
        
        if (!isset($event_config['method'])) {
            $logger = new \Modules\Core\Modul\Logs();  
            $logger->loging('handler', "['ошибка'] Не указан метод для события {$event_name}");
            throw new \Exception("Не указан метод для события {$event_name}");
        }

        $class = $event_config['class'];
        $method = $event_config['method'];

        if (!class_exists($class)) {
            $logger = new \Modules\Core\Modul\Logs();  
            $logger->loging('handler', "['ошибка'] Класс {$class} не найден");
            throw new \Exception("Класс {$class} не найден");
        }

        if (!method_exists($class, $method)) {
            $logger = new \Modules\Core\Modul\Logs();  
            $logger->loging('handler', "['ошибка'] Класс {$class} не содержит функцию {$method}");
            throw new \Exception("Класс {$class} не содержит функцию {$method}");
        }

        $handler = new $class();
        $params = $event_config['params'] ?? [];
        $params[] = $data;
        
        return call_user_func_array([$handler, $method], $params);
    }

    public function set_addres($adres){
        $this->adress = $adres;
        return $this;
    }



}
