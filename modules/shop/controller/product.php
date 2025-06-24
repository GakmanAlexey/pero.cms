<?php

namespace Modules\Shop\Controller;

Class Product extends \Modules\Abs\Controller{
    
    public function open(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);      
        $this->list_file[] = APP_ROOT."/modules/shop/view/product.php";
        $this->show();
        $this->cashe_end();
    }
}
