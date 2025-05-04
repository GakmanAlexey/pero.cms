<?php

namespace Modules\Abs;

abstract class Controller{
    public $type_show;
    public $page_load;
    public $list_file;
    public $data;
    public $cache_isset = false;
    public $cache_filename;

    public function show( $cash = false){
        switch ($this->type_show ) {
            case "default":
                $this->default();
                break;
            case "empty":
                $this->empty();
                break;
            case "admin":
                $this->admin();
                break;
            case "ajax":
                $this->ajax();
                break;
            case "api":
                $this->api();
                break;
            case "errors":
                $this->errors();
                break;
        }
    }

    public function default(){        
        $this->page_load = APP_ROOT."/modules/core/view/head.php";              
        $this->links();
        $this->page_load = APP_ROOT."/modules/core/view/header.php";              
        $this->links();
        $this->draw();
        $this->page_load = APP_ROOT."/modules/core/view/footer.php";              
        $this->links();
    }

    public function empty(){
        $this->page_load = APP_ROOT."/modules/core/view/head.php";              
        $this->links();
        $this->draw();
    }

    public function admin(){
        $build_l_menu = new \Mod\Core\Modul\Builderlmenu;
        $h = $build_l_menu ->build($h);
        $build_pex = new \Mod\Admin\Modul\Pex;
        $h = $build_pex ->seach_files($h);

        $this->page_load = APP_ROOT."/modules/core/view/head.php";              
        $this->links();
        $this->page_load = APP_ROOT."/modules/core/view/admin/lmenu.php";              
        $this->links();
        $this->page_load = APP_ROOT."/modules/core/view/admin/header.php";              
        $this->links();
        $this->draw();
        $this->page_load = APP_ROOT."/modules/core/view/admin/rmenu.php";              
        $this->links();
        
    }

    public function ajax(){
        $this->draw();
    }

    public function api(){
        $this->draw();
    }

    public function errors(){
        $this->page_load = APP_ROOT."/modules/core/view/head.php";              
        $this->links();
        $this->page_load = APP_ROOT."/modules/core/view/header.php";              
        $this->links();
        $this->draw();
        $this->page_load = APP_ROOT."/modules/core/view/footer.php";              
        $this->links();
    }

    public function cashe_start(){        
        $this->cache_isset = false;
        if(\Modules\Core\Modul\Env::get("VIEW_CACHE") != "true") return;        
        $file_name = md5(\Modules\Core\Modul\Router::$url["d_line"]."g".\Modules\Core\Modul\Router::$url["d_of_get_line"]);
        $this->cache_filename = APP_ROOT.DS.'cache'.DS.$file_name.'.cache';

        if (file_exists($this->cache_filename)) {
            $this->cache_isset = true;
            $c = @file_get_contents($this->cache_filename);
            echo $c;
            return;
        } 
        ob_start();
        return ;
    }

    public function cashe_end(){
        if(\Modules\Core\Modul\Env::get("VIEW_CACHE") != "true") return;   
        $c = ob_get_contents();
        file_put_contents($this->cache_filename, $c);
        return ;
    }


    public function draw(){        
        foreach($this->list_file as $p){
            $this->page_load  = $p;         
            $this->links();
        }
    }

    public function links(){        
        if (file_exists($this->page_load )) {
            include  $this->page_load ;            
        }else{                 
            $logger = new \Modules\Core\Modul\Logs();           
            $msg = "Не найдет файл: ".$this->page_load ;
            $logger->loging('view', $msg);
        }
    }


}
