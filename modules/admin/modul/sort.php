<?php

namespace Modules\Admin\Modul;

Class Sort{
    public function prioritet($array)
    {
       $run =  true;
        while($run){
            $x = 0;
            $run =  false;
            foreach($array as $item){
                $next = $x + 1;
                if(isset($array[$next])){
                    $el_l = $array[$x];
                    $el_r = $array[$next];
                    if($el_l["prioritet"] <= $el_r["prioritet"] ){

                    }else{
                        $array[$next] = $el_l;
                        $array[$x] = $el_r;
                        $run =  true;
                    }
                }
                $x++;
            }
        }
     
        return $array;
    }

}
