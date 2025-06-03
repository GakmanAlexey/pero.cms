<?php

namespace Modules\Abs;

abstract class Controller{
    public $type_show;
    public $page_load;
    public $list_file;
    public $data;
    public $cache_isset = false;
    public $cache_filename;
    public $data_view;

    public $user;
    public $group;

    public function verify($permission){  
        
        $user_taker = new  \Modules\User\Modul\Taker;
        if(isset($_SESSION["id"])){
            $user = $user_taker->get_from_id($_SESSION["id"]);
        }else{
            $user = $user_taker->get_from_id(0);
        }
        
        if($user->get_ban()){
            $ban = new \Modules\Core\Controller\Ban;
            $ban->index();
        }
        $group_taker = new \Modules\Group\Modul\Taker;
        $group = $group_taker->get_from_user($user);
        $srv = new \Modules\Permission\Modul\Service();
        $pex = $srv->load_pex($group, $user);
        if (in_array($permission, $pex->get_pex(), true)) {  
            return;
        } else {
            $e401 = new \Modules\Core\Controller\E401;
            $e401->index();
            die();
        }
        
       
    }

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
        $this->page_load = APP_ROOT."/modules/license/view/cookie.php";            
        $this->links();
        $this->page_load = APP_ROOT."/modules/core/view/footer.php";              
        $this->links();
    }

    public function empty(){
        $this->page_load = APP_ROOT."/modules/core/view/head.php";              
        $this->links();
        $this->draw();
    }

    public function admin(){
        \Modules\Admin\Modul\Buildermenu::seach_files();
        $this->verify("auth");
        $this->user_data_auth();


        $this->page_load = APP_ROOT."/modules/admin/view/head.php";              
        $this->links();
        $this->page_load = APP_ROOT."/modules/admin/view/lmenu.php";              
        $this->links();
        $this->page_load = APP_ROOT."/modules/admin/view/header.php";              
        $this->links();
        $this->draw();
        $this->page_load = APP_ROOT."/modules/admin/view/rmenu.php";              
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
        $this->page_load = APP_ROOT."/modules/license/view/cookie.php";            
        $this->links();
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

    public function user_data_auth(){
        if(!(isset($_SESSION["id"]) and ($_SESSION["id"] >= 1))) return;
        $taker = new \Modules\User\Modul\Taker;
        $this->user = $taker->get_from_id($_SESSION["id"]);
        $taker_gp = new \Modules\Group\Modul\Taker;
        $this->group = $taker_gp->get_from_user($this->user);
    }


}
