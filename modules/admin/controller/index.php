<?php

namespace Modules\Admin\Controller;

Class Index extends \Modules\Abs\Controller{

    public function index(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "admin";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        
        $this->list_file[] = APP_ROOT."/modules/admin/view/index.php";
        $this->show();
        $this->cashe_end();
    }

}
