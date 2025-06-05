<?php

namespace Modules\Admin\Modul;

class Buildermenu{
    public static $pre_data = [];
    public static $build_lvl1 =[];
    public static $pre_build_lvl1 = [];
    public static $pre_build_lvl2 = [];
    public static $pre_build_lvl3 = [];

    public static function  seach_files(){
        $modules_list =  scandir(APP_ROOT.DS."modules");
        array_splice($modules_list , 0 ,  2);
        foreach($modules_list as $modules){
            $dir_in_modules_list = scandir(APP_ROOT.DS."modules".DS.$modules);
            array_splice($dir_in_modules_list , 0 ,  2);            
            foreach($dir_in_modules_list as $dir_CIMSV){
                if($dir_CIMSV  == "modul"){
                    $path_file = APP_ROOT.DS."modules".DS.$modules.DS."modul".DS."admin".DS."lmenu.php";
                    if(file_exists($path_file)){
                        $class = '\\Modules\\'.ucfirst($modules).'\\Modul\\Admin\\Lmenu';                     
                        $funct2 = "build";
                        $result = new $class();
                        $result->$funct2();      
                    }
                }
            }
        }
        self::build_menu();
        ksort(self::$build_lvl1);
    }
    public static function add_element($father, $name_en, $name_ru, $url, $prioritet, $action, $ico, $permission){
        $array = [
            "father" => $father,
            "name_en" => $name_en,
            "name_ru" => $name_ru,
            "url" => $url,
            "prioritet" => $prioritet,
            "pos" => $action,
            "ico" => $ico,
            "permission" => $permission
        ];
        self::$pre_data[] = $array;
    }

    public static function  build_menu(){
        self::build_lvl1();
        self::build_lvl2();
        self::build_lvl3();
    }

    public static function  build_lvl1(){
        foreach(self::$pre_data as $item){
            if($item["father"] == "/"){
                self::$pre_build_lvl1[] = $item;
            }
        }

        $sort = new \Modules\Admin\Modul\Sort;
        self::$pre_build_lvl1 = $sort -> prioritet(self::$pre_build_lvl1);
        self::build_lvl1_save();
    }

    public static function  build_lvl2(){
        foreach(self::$build_lvl1 as $father){
            foreach(self::$pre_data as $item){
                if($item["father"] == $father["name_en"]){
                    self::$pre_build_lvl2[] = $item;
                }
            }
        }
        $sort = new \Modules\Admin\Modul\Sort;
        self::$pre_build_lvl2 = $sort -> prioritet(self::$pre_build_lvl2);
        self::build_lvl2_save();
    }

    public static function  build_lvl3(){        
        foreach(self::$pre_build_lvl2 as $father){
            foreach(self::$pre_data as $item){
                if($item["father"] == $father["name_en"]){
                   self::$pre_build_lvl3[] = $item;
                }
            }
        }

        $sort = new \Modules\Admin\Modul\Sort;
        self::$pre_build_lvl3 = $sort -> prioritet(self::$pre_build_lvl3);
        self::build_lvl3_save();
    }

    public static function build_lvl1_save(){
        $x = 0;
        foreach(self::$pre_build_lvl1 as $item){
           self::$build_lvl1[$x] = $item;
            $x = $x +10000;
        }
    }

    public static function build_lvl2_save(){
        $x = 0;
        $start = [];
        foreach(self::$build_lvl1 as $key => $val){
            $start[$val["name_en"]] = $key;
        }

        foreach(self::$pre_build_lvl2 as $item){
            foreach($start as $key => $val){
                if($item["father"] == $key){
                    $start[$key] = ($val + 100);
                    self::$build_lvl1[$start[$key]] = $item;
                }
            }
        }
    }

    public static function build_lvl3_save(){
        $x = 0;
        $start = [];
        foreach(self::$build_lvl1 as $key => $val){
            $start[$val["name_en"]] = $key;
        }

        foreach(self::$pre_build_lvl3 as $item){
            foreach($start as $key => $val){
                if($item["father"] == $key){
                    $start[$key] = ($val + 1);
                    self::$build_lvl1[$start[$key]] = $item;
                }
            }
        }
    }
   
}