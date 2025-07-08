<?php

namespace Modules\Shop\Controller;

Class Product extends \Modules\Abs\Controller{
    
    public function open(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);  
        $prod = new \Modules\Shop\Modul\Takerproduct;
        $this->data_view["product"] = $prod->take_data_prod();
        $spec = new \Modules\Shop\Modul\Specificservice;
        $this->data_view["product"]->set_specific($spec->show_data_product_id( $this->data_view["product"]->get_id()));
        $brand = new \Modules\Shop\Modul\Brandmanager;
        $brand_inem = new \Modules\Shop\Modul\Brand;
        $brand_inem->set_id($this->data_view["product"]->get_brand_id());
        $this->data_view["brand"] = $brand->select( $brand_inem);

        $this->list_file[] = APP_ROOT."/modules/shop/view/product.php";
        $this->show();
        $this->cashe_end();
    }
}
