<?php

namespace Modules\Group\Modul\Admin;

Class Lmenu extends \Modules\Abs\Lmenu{
    
    public function build(){
        
        $ico_site = '<svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.8332 13.0001V9.75008C23.8332 4.33341 21.6665 2.16675 16.2498 2.16675H9.74984C4.33317 2.16675 2.1665 4.33341 2.1665 9.75008V16.2501C2.1665 21.6667 4.33317 23.8334 9.74984 23.8334H12.9998" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M22.7066 19.3266L20.9408 19.9225C20.4533 20.085 20.0633 20.4641 19.9008 20.9625L19.305 22.7283C18.7958 24.2558 16.6508 24.2233 16.1741 22.6958L14.17 16.25C13.78 14.9716 14.9608 13.7799 16.2283 14.1808L22.685 16.185C24.2016 16.6616 24.2233 18.8174 22.7066 19.3266Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>';
        

        \Modules\Admin\Modul\Buildermenu::add_element(
            "system",                        //Родитель   
            "group",              //Название на латинице
            "Группы" ,     //Название на Русском
            "group",              //Url адрес
            3,                          //Приоритет
            1,                          //TODO Вид действия
            $ico_site,                    //Иконка
            "admin"         //Привелегии
        );
    }
}
