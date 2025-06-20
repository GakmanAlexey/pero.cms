<?php

namespace Modules\Core\Modul;

class Css {
    private $css_files_default = [];
    private $css_files_admin = [];
    private $minify = false;
    private $output_default;
    private $output_admin;

    public function __construct(bool $minify = false){
        $css_lists = $this->get_css_lists();
        $list_css_default = $css_lists['default'];
        $list_css_admin = $css_lists['admin'];

        foreach ($list_css_default as $default_file) {
            $normalized_path_default_file = str_replace(['/', '\\'], DS, $default_file);
            $normalized_path_default_file = preg_replace('/' . preg_quote(DS, '/') . '+/', DS, $normalized_path_default_file);
            $this->css_files_default[] = $normalized_path_default_file;
        }
        foreach ($list_css_admin as $admin_file) {
            $normalized_path_admin_file = str_replace(['/', '\\'], DS, $admin_file);
            $normalized_path_admin_file = preg_replace('/' . preg_quote(DS, '/') . '+/', DS, $normalized_path_admin_file);
            $this->css_files_admin[] = $normalized_path_admin_file;
        }
        $this->minify = $minify;
        $this->output_default =  APP_ROOT.DS."src".DS."css".DS."style.css";
        $this->output_admin = APP_ROOT.DS."src".DS."css".DS."admin.css";
    }

    public function merge(){
        $this->merge_admin();
        $this->merge_default();
    }

    public function merge_admin(){
        $merged_admin = '';
        foreach ($this->css_files_admin as $file) {
            $file = APP_ROOT.DS.$file;
            if (!file_exists($file)) {
                $logger = new \Modules\Core\Modul\Logs();       
                $logger->loging('css', "['ошибка'] файл не найден {$file}");
                throw new \Exception("CSS file not found: {$file}");
            }            
            $content = file_get_contents($file);            
            if ($this->minify) {
                $content = $this->minify_css($content);
            }            
            $merged_admin .= $content . "\n";
        }
        file_put_contents($this->output_admin, $merged_admin);
    }

    public function merge_default(){
        $merged_default = '';
        foreach ($this->css_files_default as $file) {
            $file = APP_ROOT.DS.$file;
            if (!file_exists($file)) {
                $logger = new \Modules\Core\Modul\Logs();       
                $logger->loging('css', "['ошибка'] файл не найден {$file}");
                throw new \Exception("CSS file not found: {$file}");
            }            
            $content = file_get_contents($file);            
            if ($this->minify) {
                $content = $this->minify_css($content);
            }            
            $merged_default .= $content . "\n";
        }
        file_put_contents($this->output_default, $merged_default);
    }

    private function minify_css($css){
        $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
        $css = str_replace(["\r\n", "\r", "\n", "\t", '  ', '    ', '    '], '', $css);
        $css = str_replace([' {', '{ '], '{', $css);
        $css = str_replace([' }', '} '], '}', $css);
        $css = str_replace([': ', ' :'], ':', $css);
        $css = str_replace(['; ', ' ;'], ';', $css);
        $css = str_replace(', ', ',', $css);        
        return $css;
    }

    public static function merge_files(bool $minify = false){
        $merger = new self($minify);
        return $merger->merge();
    }

    public static function merge_files_admin(bool $minify = false){
        $merger = new self($minify);
        return $merger->merge_admin();
    }

    public static function merge_files_default(bool $minify = false){
        $merger = new self($minify);
        return $merger->merge_default();
    }



    function get_css_lists() {
        $jsonPath = APP_ROOT.DS."modules".DS."core".DS."modul".DS."css.json";
        if (!file_exists($jsonPath)) {
                $logger = new \Modules\Core\Modul\Logs();       
                $logger->loging('css', "['ошибка'] файл не найден {$jsonPath}. Конфигурации не определенны");
            throw new Exception("CSS config file not found: {$jsonPath}");
        }

        $jsonContent = file_get_contents($jsonPath);
        $config = json_decode($jsonContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
                $logger = new \Modules\Core\Modul\Logs();       
                $logger->loging('css', "['ошибка'] файл поврежден {$jsonPath}. Конфигурации не могут быть прочитаны");
            throw new Exception("Invalid JSON in CSS config: " . json_last_error_msg());
        }

        return [
            'default' => $config['default'] ?? [],
            'admin' => $config['admin'] ?? []
        ];
    }
}