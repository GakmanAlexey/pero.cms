<?php

namespace Modules\Shop\Controller;

Class Catalog extends \Modules\Abs\Controller{
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

    
    public function main(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);  
        $taker = new \Modules\Shop\Modul\Takecatalog;  
        $this->data_view["categor_list"] = $taker->take_categor_main();  
        $this->list_file[] = APP_ROOT."/modules/shop/view/catalog_main.php";
        $this->show();
        $this->cashe_end();
    }

    
    public function open(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);    
        $taker = new \Modules\Shop\Modul\Takecatalog;  
        $this->data_view["categor_list"] = $taker->take_categor_open();        
        $this->list_file[] = APP_ROOT."/modules/shop/view/catalog_open.php" ; 
        $this->list_file[] = APP_ROOT."/modules/shop/view/filter.php";
        $this->list_file[] = APP_ROOT."/modules/shop/view/product_list.php";
        $this->show();
        $this->cashe_end();
    }
}
