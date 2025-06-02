<?php

namespace Modules\Admin\Modul\Admin;

Class Lmenu extends \Modules\Abs\Lmenu{
    
    public function build(){
        $ico = '
        <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M23.8332 13.0001V9.75008C23.8332 4.33341 21.6665 2.16675 16.2498 2.16675H9.74984C4.33317 2.16675 2.1665 4.33341 2.1665 9.75008V16.2501C2.1665 21.6667 4.33317 23.8334 9.74984 23.8334H12.9998" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M22.7066 19.3266L20.9408 19.9225C20.4533 20.085 20.0633 20.4641 19.9008 20.9625L19.305 22.7283C18.7958 24.2558 16.6508 24.2233 16.1741 22.6958L14.17 16.25C13.78 14.9716 14.9608 13.7799 16.2283 14.1808L22.685 16.185C24.2016 16.6616 24.2233 18.8174 22.7066 19.3266Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        ';
        \Modules\Admin\Modul\Buildermenu::add_element(
            "/",                        //Родитель   
            "site",              //Название на латинице
            "Сайт " ,     //Название на Русском
            "site",              //Url адрес
            1,                          //Приоритет
            1,                          //TODO Вид действия
            $ico,                    //Иконка
            "constructor.admin"         //Привелегии
        );
        
        $ico = '
        <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M9.2085 15.4375C9.2085 17.5175 10.9202 19.2292 13.0002 19.2292C15.0802 19.2292 16.7918 17.5175 16.7918 15.4375" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M9.54423 2.16675L5.62256 6.09925" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M16.4561 2.16675L20.3777 6.09925" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M2.1665 8.50407C2.1665 6.4999 3.239 6.3374 4.5715 6.3374H21.4282C22.7607 6.3374 23.8332 6.4999 23.8332 8.50407C23.8332 10.8332 22.7607 10.6707 21.4282 10.6707H4.5715C3.239 10.6707 2.1665 10.8332 2.1665 8.50407Z" stroke="white" stroke-width="1.5"/>
        <path d="M3.7915 10.8333L5.319 20.1933C5.66567 22.2949 6.49984 23.8333 9.59817 23.8333H16.1307C19.4998 23.8333 19.9982 22.3599 20.3882 20.3233L22.2082 10.8333" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        
        ';
       \Modules\Admin\Modul\Buildermenu::add_element(
            "/",                        //Родитель   
            "shop",              //Название на латинице
            "Магазин " ,     //Название на Русском
            "shop",              //Url адрес
            2,                          //Приоритет
            1,                          //TODO Вид действия
            $ico,                    //Иконка
            "constructor.admin"         //Привелегии
        );

       \Modules\Admin\Modul\Buildermenu::add_element(
            "shop",                        //Родитель   
            "test",              //Название на латинице
            "test " ,     //Название на Русском
            "test",              //Url адрес
            2,                          //Приоритет
            1,                          //TODO Вид действия
            $ico,                    //Иконка
            "constructor.admin"         //Привелегии
        );
 
        
        //$father, $name_en, $name_ru, $url, $prioritet, $action, $ico, $permission
    }
}
