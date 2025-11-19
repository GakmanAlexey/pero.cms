<?php

namespace Modules\Card\Modul;

class Cardshow{    
   
    public function jobCard(){

    }

    public function cardLoad(){
        $cm = new \Modules\Card\Modul\Cardmeneger;
        $cm::load();
        $card = $cm::$card;

        $cardLoadData = new \Modules\Card\Modul\Cardloaddata;
        return $cardLoadData->load($card);
    }
    
}

    
