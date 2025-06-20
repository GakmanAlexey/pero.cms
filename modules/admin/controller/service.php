<?php

namespace Modules\Admin\Controller;

Class Service extends \Modules\Abs\Controller{

    public function index(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $service = new \Modules\Admin\Modul\Buildservice;
        $service->build();
        $this->data_view["list_service"] = $service->array_service;
        $this->list_file[] = APP_ROOT."/modules/admin/view/service.php";
        $this->show();
        $this->cashe_end();
    }

}
