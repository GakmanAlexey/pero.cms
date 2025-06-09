<?php

namespace Modules\Seo\Controller;

Class Admin extends \Modules\Abs\Controller{

    public function index(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $taker = new \Modules\Seo\Modul\Taker;
        $this->view_data = $taker->show_all();
        $this->list_file[] = APP_ROOT."/modules/seo/view/admin/index.php";
        $this->show();
        $this->cashe_end();
    }

        public function edit(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $manager = new \Modules\Seo\Modul\Manager;
        $this->view_data2 = $manager->save();
        $taker = new \Modules\Seo\Modul\Taker;
        $this->view_data = $taker->show_item();
        $this->list_file[] = APP_ROOT."/modules/seo/view/admin/edit.php";
        $this->show();
        $this->cashe_end();
    }
    
}
