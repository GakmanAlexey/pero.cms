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
    
}
