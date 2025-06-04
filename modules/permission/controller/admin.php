<?php

namespace Modules\Permission\Controller;

Class Admin extends \Modules\Abs\Controller{

    public function index(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $service =  new \Modules\Permission\Modul\Service;
        $this->data_view =$service->get_all_pex();

        $this->list_file[] = APP_ROOT."/modules/permission/view/admin/index.php";
        $this->show();
        $this->cashe_end();
    }

        public function edit(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $service =  new \Modules\Permission\Modul\Service;
        $this->data_view2 =$service->get_save();
        $this->data_view =$service->get_data();
        $this->list_file[] = APP_ROOT."/modules/permission/view/admin/edit.php";
        $this->show();
        $this->cashe_end();
    }
    
}
