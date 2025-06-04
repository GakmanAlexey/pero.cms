<?php

namespace Modules\Group\Controller;

Class Admin extends \Modules\Abs\Controller{

    public function index(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $taker = new \Modules\Group\Modul\Taker;
        $this->data_view = $taker->get_all_groups();
        $this->list_file[] = APP_ROOT."/modules/group/view/admin/index.php";
        $this->show();
        $this->cashe_end();
    }

        public function edit(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $taker = new \Modules\Group\Modul\Taker;
        $this->data_view2 = $taker->save_edit_admin();
        $this->data_view = $taker->get_data_group();
        $this->list_file[] = APP_ROOT."/modules/group/view/admin/edit.php";
        $this->show();
        $this->cashe_end();
    }
    
}
