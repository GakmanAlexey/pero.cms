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
        $product_list  =  new \Modules\Shop\Modul\Productlist;  
        $this->data_view["product_list"] = $product_list->logic_open_categor();  
        $variant = new \Modules\Shop\Modul\Variationservice;
        $res = $variant->show_prod_and_variant($this->data_view["product_list"]->get_list_product());  
        
        $this->data_view["categor_list_filter"] = new \Modules\Shop\Modul\Filtermenedger;
        $this->data_view["categor_list_filter"]->init_job_array($this->data_view["product_list"]->get_list_product());

        $fjob = new \Modules\Shop\Modul\Filterjob;
        $this->data_view["product_list"] = $fjob->get_Apply($this->data_view["product_list"]);
        $this->list_file[] = APP_ROOT."/modules/shop/view/catalog_open.php" ; 
        $this->list_file[] = APP_ROOT."/modules/shop/view/filter.php";
        $this->list_file[] = APP_ROOT."/modules/shop/view/product_list.php";
        $this->show();
        $this->cashe_end();
    }
}
