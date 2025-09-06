<?php

namespace Modules\Shop\Modul;

class Filtermenedger{
    public $filter;
    public function init_job_array($product_list){
        $this->filter = new \Modules\Shop\Modul\Filters;
        foreach($product_list as $product){
            $this->init_job($product);
        } 
        $this->filter->sort_specification_values();  
        $this->filter->load_brend_data();  
    }

    public function init_job(\Modules\Shop\Modul\Product $product){
        $this->filter->add_brand($product->get_brand_id());
        $this->filter->add_prise($product->get_price());
        //var_dump( $product->get_brand_id()); 
        //var_dump( $product->get_price()); 

        
        $this->filter->set_unique_specifications($product->get_specific());
        //$this->filter->add_brand():
        //var_dump("<pre>", $product->get_specific() , "</pre>");
    }
    
}