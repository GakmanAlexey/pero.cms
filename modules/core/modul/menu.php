<?php

namespace Modules\Core\Modul;

class Menu {
    public static $menu;

    public static function create($name){
        self::$menu["$name"] = [];
    }
    
    public static function add_element($name_menu, $value, $name = null){
        if($name == null){
            self::$menu["$name_menu"][] = $value;
        }else{
            self::$menu["$name_menu"]["$name"] = $value;
        }
    }
    public static function get_element($name_menu){
        return self::$menu["$name_menu"];
    }

    public static function build(){
        self::create("nav");
        self::add_element("nav", ["nav_element","logo","/"], "logo");
        self::add_element("nav", ["nav_element","401","/401/"], "401");
        self::add_element("nav", ["nav_element","404","/404/"], "404");
        self::add_element("nav", ["nav_element","test","/test/"], "test");
    }
}