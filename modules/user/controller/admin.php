<?php

namespace Modules\User\Controller;

Class Admin extends \Modules\Abs\Controller{

    public function index(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $taker = new \Modules\User\Modul\Taker;
        $this->data_view = $taker->get_all_user();
        $this->list_file[] = APP_ROOT."/modules/user/view/admin/index.php";
        $this->show();
        $this->cashe_end();
    }
    
    public function edit(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $service = new \Modules\User\Modul\Service;
        $res = $service->save_edit_admin();
        $this->data_view2 = $res->msg;
        $taker = new \Modules\User\Modul\Taker;
        $this->data_view = $taker-> get_from_id($_GET["id"]);
        $this->list_file[] = APP_ROOT."/modules/user/view/admin/edit.php";
        $this->show();
        $this->cashe_end();
    }
    
}
