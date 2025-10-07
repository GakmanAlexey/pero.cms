<?php

namespace Modules\Card\Modul;

class Cardajax{    
   
    public function viewCountProduct(){
        $cm = new \Modules\Card\Modul\Cardmeneger;
        $cm::load();
        $card = $cm::$card; 
        $cardManager = new \Modules\Card\Modul\Cardmeneger;
        $count = $cardManager->countProduct($card);
        return $count;
    }
    
}

    
