<?php

namespace Modules\Core\Modul;

class Css {
    private $css_files_default = [];
    private $css_files_admin = [];
    private $minify = false;
    private $output_default;
    private $output_admin;

    public function __construct(bool $minify = false){
        $list_css_default = explode(',',\Modules\Core\Modul\Env::get("HEAD_CSS_DEFAULT_LIST"));
        $list_css_admin = explode(',',\Modules\Core\Modul\Env::get("HEAD_CSS_ADMIN_LIST"));

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
}