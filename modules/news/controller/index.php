<?php

namespace Modules\News\Controller;

Class Index extends \Modules\Abs\Controller{

    public function categor(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);  
        $cat = new \Modules\News\Modul\Taker();
        $this->data_view["cat_list"] =  $cat->get_all_categor();
        $this->data_view["news_list"] =  $cat->get_list_news();
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
        $cat = new \Modules\News\Modul\Taker();
        $this->data_view["news"] = $cat->get_news();   
        $this->data_view["news2"] = $cat->get_2news_in_category($this->data_view["news"]->get_categor_id(), $this->data_view["news"]->get_id());     
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
        $cat = new \Modules\News\Modul\Taker();  
        $this->data_view["carusel"] = $cat->get_carusel(5);     
        $this->list_file[] = APP_ROOT."/modules/news/view/block.php";
        $this->show();
        $this->cashe_end();
    }

}
