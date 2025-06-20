<?php

namespace Modules\Admin\Modul;

Class Buildservice{
    public $array_service = [];    
    private $modulesDir = APP_ROOT . DS. 'modules';

    public function build(){        
        $modules = scandir($this->modulesDir);

        foreach ($modules as $module) {
            if ($this->is_invalid_module($module)) {
                continue;
            }
            
            $service_file = $this->get_service_file_path($module);
            $this->process_service_file($module, $service_file);
        }
    }

    private function is_invalid_module(string $module){
        return $module === '.' || $module === '..' || !is_dir($this->modulesDir . DS . $module);
    }

    private function get_service_file_path(string $module){
        return $this->modulesDir . DS . $module . DS . 'install' . DS . 'servicefun.json';
    }
    
    private function process_service_file(string $module_name, string $service_file){
        if (!file_exists($service_file)) {
            return;
        }

        $jsonContent = file_get_contents($service_file);
        $services = json_decode($jsonContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $logger = new \Modules\Core\Modul\Logs();       
            $logger->loging('service', "['ошибка'] JSON {$module_name}/install/servicefun.json - ошибка чтения  ");
            return;
        }

        $this->validate_and_add_service($services, $module_name);
    }

    private function validate_and_add_service(array $services, string $module_name){
        foreach ($services as $service) {
            $service_class = new \Modules\Admin\Modul\Service;
            $service_class->set_img($service["img"])
                ->set_name($service["name"])
                ->set_description($service["description"])
                ->set_buttons($service["buttons"]);
            $this->array_service[] = $service_class;
        }
    }
}
