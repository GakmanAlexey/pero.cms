<?php

namespace Modules\Files\Controller;

Class Admin extends \Modules\Abs\Controller{

    public function index(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $taker = new \Modules\Files\Modul\Taker;
        $this->view_data = $taker->get_all_files();
        $this->list_file[] = APP_ROOT."/modules/files/view/admin/index.php";
        $this->show();
        $this->cashe_end();
    }

        public function new(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $service = new \Modules\Files\Modul\Service;
        $this->view_data = $service->save_files();
        $this->list_file[] = APP_ROOT."/modules/files/view/admin/new.php";
        $this->show();
        $this->cashe_end();
    }
    
}
