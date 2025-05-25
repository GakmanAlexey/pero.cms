<?php

namespace Modules\License\Controller;

Class Index extends \Modules\Abs\Controller{
    public function index(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        
        $this->list_file[] = APP_ROOT."/modules/license/view/license.php";
        $this->show();
        $this->cashe_end();
    }

}
