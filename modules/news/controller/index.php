<?php

namespace Modules\News\Controller;

Class Index extends \Modules\Abs\Controller{

    public function categor(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);         
        $this->list_file[] = APP_ROOT."/modules/news/view/categor.php";
        $this->show();
        $this->cashe_end();
    }
    public function news(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);         
        $this->list_file[] = APP_ROOT."/modules/news/view/news.php";
        $this->show();
        $this->cashe_end();
    }
    public function block(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);         
        $this->list_file[] = APP_ROOT."/modules/news/view/block.php";
        $this->show();
        $this->cashe_end();
    }

}
