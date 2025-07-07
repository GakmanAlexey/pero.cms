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
        $prod_service = new \Modules\Shop\Modul\Productservice;
        $product_list= $prod_service->show_all();

        $this->data_view["show_all"]=$product_list;
        $this->list_file[] = APP_ROOT."/modules/shop/view/admin/editproduct.php";
        $this->show();
        $this->cashe_end();
    }

    

    public function variation(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $prod_service = new \Modules\Shop\Modul\Productservice;
        $this->data_view["show_all"] = $prod_service->show_all();
        $variant_service = new \Modules\Shop\Modul\Variationservice;
        $this->data_view["show_all"] = $variant_service->show_prod_and_variant($this->data_view["show_all"]);
        $this->list_file[] = APP_ROOT."/modules/shop/view/admin/variation.php";
        $this->show();
        $this->cashe_end();
    }

    public function newvariation(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $prod_service = new \Modules\Shop\Modul\Variationservice;
        $this->data_view["result_add"] = $prod_service->create();
        $this->list_file[] = APP_ROOT."/modules/shop/view/admin/newvariation.php";
        $this->show();
        $this->cashe_end();
    }

    public function editvariation(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $this->list_file[] = APP_ROOT."/modules/shop/view/admin/editvariation.php";
        $this->show();
        $this->cashe_end();
    }


    
    public function specific(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $service = new \Modules\Shop\Modul\Specificservice;
        $this->data_view["list"] = $service->show_all();
        $this->list_file[] = APP_ROOT."/modules/shop/view/admin/specific.php";
        $this->show();
        $this->cashe_end();
    }

    public function newspecific(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $service = new \Modules\Shop\Modul\Specificoneservice;
        $this->data_view["result_add"] = $service->create();
        $this->list_file[] = APP_ROOT."/modules/shop/view/admin/newspecific.php";
        $this->show();
        $this->cashe_end();
    }

    public function editspecific(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $this->list_file[] = APP_ROOT."/modules/shop/view/admin/editspecific.php";
        $this->show();
        $this->cashe_end();
    }

    public function productspecific(){
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $service = new \Modules\Shop\Modul\Specificservice;
        $this->data_view["result_add"] = $service->save_product();
        $this->data_view["list_all"] = $service->show_all();
        $this->data_view["show_data_product"] = $service->show_data_product();
        $this->data_view["show_data_vacant"] = $service->clear_no_active($this->data_view["list_all"],$this->data_view["show_data_product"]);
        $this->list_file[] = APP_ROOT."/modules/shop/view/admin/productspecific.php";
        $this->show();
        $this->cashe_end();
    }

    public function variationspecific(){
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $service = new \Modules\Shop\Modul\Specificservice;
        $this->data_view["result_add"] = $service->save_varianrt();
        $this->data_view["list_all"] = $service->show_all();
        $this->data_view["show_data_product"] = $service->show_data_variant();
        $this->data_view["show_data_vacant"] = $service->clear_no_active($this->data_view["list_all"],$this->data_view["show_data_product"]);
        $this->list_file[] = APP_ROOT."/modules/shop/view/admin/variationspecific.php";
        $this->show();
        $this->cashe_end();
    }
    
}
