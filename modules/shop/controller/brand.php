<?php

namespace Modules\Shop\Controller;

Class Brand extends \Modules\Abs\Controller{
    public function index(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);        
        $this->list_file[] = APP_ROOT."/modules/shop/view/index.php";
        $this->show();
        $this->cashe_end();
    }
    public function test(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);        
        $this->list_file[] = APP_ROOT."/modules/shop/view/test.php";
        $this->show();
        $this->cashe_end();
    }
    public function open(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);    
        $manager = new \Modules\Shop\Modul\Brandmanager;  
        $this->data_view = $manager->select_from_url();
        $this->list_file[] = APP_ROOT."/modules/shop/view/brand.php";
        $this->show();
        $this->cashe_end();
    }
    public function block(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);        
        $this->list_file[] = APP_ROOT."/modules/shop/view/block.php";
        $this->show();
        $this->cashe_end();
    }

}
