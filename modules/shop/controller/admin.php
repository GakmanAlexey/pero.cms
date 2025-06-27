<?php

namespace Modules\Shop\Controller;

Class Admin extends \Modules\Abs\Controller{
//brand
    public function brand(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $bs = new \Modules\Shop\Modul\Brandservice;
        $this->data_view = $bs->show_all();
        $this->list_file[] = APP_ROOT."/modules/shop/view/admin/brand.php";
        $this->show();
        $this->cashe_end();
    }

    public function newbrand(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $bs = new \Modules\Shop\Modul\Brandservice;
        $this->data_view = $bs->create_new();
        $this->list_file[] = APP_ROOT."/modules/shop/view/admin/newbrand.php";
        $this->show();
        $this->cashe_end();
    }

    public function editbrand(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $this->list_file[] = APP_ROOT."/modules/shop/view/admin/editbrand.php";
        $this->show();
        $this->cashe_end();
    }

    
    public function categor(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $service = new \Modules\Shop\Modul\Catalogservice;
        $this->data_view["categor"] = $service->show_list();
        $this->list_file[] = APP_ROOT."/modules/shop/view/admin/categor.php";
        $this->show();
        $this->cashe_end();
    }

    public function newcategor(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $service = new \Modules\Shop\Modul\Catalogservice;
        $this->data_view["categor"] = $service->list_select_all();
        $this->data_view["result"] = $service->save_new();
        $this->list_file[] = APP_ROOT."/modules/shop/view/admin/newcategor.php";
        $this->show();
        $this->cashe_end();
    }

    public function editcategor(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $this->list_file[] = APP_ROOT."/modules/shop/view/admin/editcategor.php";
        $this->show();
        $this->cashe_end();
    }

    

    public function product(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $prod_service = new \Modules\Shop\Modul\Productservice;
        $this->data_view["show_all"] = $prod_service->show_all();
        $this->list_file[] = APP_ROOT."/modules/shop/view/admin/product.php";
        $this->show();
        $this->cashe_end();
    }

    public function newproduct(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $service = new \Modules\Shop\Modul\Catalogservice;
        $this->data_view["categor_list"] = $service->show_list();
        $prod_service = new \Modules\Shop\Modul\Productservice;
        $this->data_view["result_add"] = $prod_service->create_new();
        $this->list_file[] = APP_ROOT."/modules/shop/view/admin/newproduct.php";
        $this->show();
        $this->cashe_end();
    }

    public function editproduct(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $this->list_file[] = APP_ROOT."/modules/shop/view/admin/editproduct.php";
        $this->show();
        $this->cashe_end();
    }
    
}
