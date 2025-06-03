<?php

namespace Modules\Core\Modul;

class Resource{
    public static $cssFiles = [];
    public static $jsFiles = [];
    public static $css_list;
    public static $js_list;
    public static $type;

    public static function addCss( $path) {
        self::$cssFiles[] = $path;
    }
    public static function addJs( $path) {
        self::$jsFiles[] = $path;
    }

    public static function load_css(){
        self::$css_list = '';
        foreach (self::$cssFiles as $css) {
            $css = preg_replace('/\s+/', '', $css);
            self::$css_list .= '<link rel="stylesheet" href="/' . htmlspecialchars($css) . '">';
        }
        return self::$css_list;
    }

    public static function load_js(){
        self::$js_list = '';
        foreach (self::$jsFiles as $js) {
            $js = preg_replace('/\s+/', '', $js);
            self::$js_list .= '<script src="/' . htmlspecialchars($js) . '"></script>';
        }
        return self::$js_list;
    }

    public static function load_conf($type){
        self::$type = $type;
        switch (self::$type ) {
            case "default":
                self::load_conf_default();
                break;
            case "admin":
                self::load_conf_admin();
                break;
            case "empty":
                self::load_conf_empty();
                break;
            default:
                self::load_conf_default();
        }
    }

    public static function load_conf_default(){
        self::load_conf_arr_css(["src/css/style.css"]);
        self::load_conf_arr_js(explode(',',\Modules\Core\Modul\Env::get("HEAD_JS_DEFAULT_LIST")));
    }
    public static function load_conf_admin(){
        self::load_conf_arr_css(["src/css/admin.css"]);
        self::load_conf_arr_js(explode(',',\Modules\Core\Modul\Env::get("HEAD_JS_ADMIN_LIST")));
    }
    public static function load_conf_empty(){

    }
    public static function load_conf_arr_css($css_list){
        foreach($css_list as $css){
            if($css != ""){
                self::addCss($css);
            }
        }
    }
    public static function load_conf_arr_js($js_list){
        foreach($js_list as $js){
            if($js != ""){
                self::addJs($js);
            }
        }
    }
}