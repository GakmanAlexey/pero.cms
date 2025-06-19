<?php

namespace Modules\Admin\Modul\Admin;

Class Lmenu extends \Modules\Abs\Lmenu{
    
    public function build(){

        $ico = '<svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M9.20817 20.5834H8.6665C4.33317 20.5834 2.1665 19.5001 2.1665 14.0834V8.66675C2.1665 4.33341 4.33317 2.16675 8.6665 2.16675H17.3332C21.6665 2.16675 23.8332 4.33341 23.8332 8.66675V14.0834C23.8332 18.4167 21.6665 20.5834 17.3332 20.5834H16.7915C16.4557 20.5834 16.1307 20.7459 15.9248 21.0167L14.2998 23.1834C13.5848 24.1367 12.4148 24.1367 11.6998 23.1834L10.0748 21.0167C9.9015 20.7784 9.50067 20.5834 9.20817 20.5834Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M7.5835 8.66675H18.4168" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M7.5835 14.0833H14.0835" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>        
        ';
        
        $ico_site = '<svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.8332 13.0001V9.75008C23.8332 4.33341 21.6665 2.16675 16.2498 2.16675H9.74984C4.33317 2.16675 2.1665 4.33341 2.1665 9.75008V16.2501C2.1665 21.6667 4.33317 23.8334 9.74984 23.8334H12.9998" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M22.7066 19.3266L20.9408 19.9225C20.4533 20.085 20.0633 20.4641 19.9008 20.9625L19.305 22.7283C18.7958 24.2558 16.6508 24.2233 16.1741 22.6958L14.17 16.25C13.78 14.9716 14.9608 13.7799 16.2283 14.1808L22.685 16.185C24.2016 16.6616 24.2233 18.8174 22.7066 19.3266Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>';
        
        $ico_shop = '<svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.2085 15.4375C9.2085 17.5175 10.9202 19.2292 13.0002 19.2292C15.0802 19.2292 16.7918 17.5175 16.7918 15.4375" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M9.54423 2.16675L5.62256 6.09925" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M16.4561 2.16675L20.3777 6.09925" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2.1665 8.50407C2.1665 6.4999 3.239 6.3374 4.5715 6.3374H21.4282C22.7607 6.3374 23.8332 6.4999 23.8332 8.50407C23.8332 10.8332 22.7607 10.6707 21.4282 10.6707H4.5715C3.239 10.6707 2.1665 10.8332 2.1665 8.50407Z" stroke="white" stroke-width="1.5"/>
                <path d="M3.7915 10.8333L5.319 20.1933C5.66567 22.2949 6.49984 23.8333 9.59817 23.8333H16.1307C19.4998 23.8333 19.9982 22.3599 20.3882 20.3233L22.2082 10.8333" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                </svg>';

        $ico_crm = '<svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.8332 14.0834V9.75008C23.8332 4.33341 21.6665 2.16675 16.2498 2.16675H9.74984C4.33317 2.16675 2.1665 4.33341 2.1665 9.75008V16.2501C2.1665 21.6667 4.33317 23.8334 9.74984 23.8334H14.0832" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M7.94092 15.6975L10.5193 12.35C10.8876 11.8733 11.5701 11.7867 12.0468 12.155L14.0293 13.715C14.5059 14.0833 15.1884 13.9967 15.5568 13.5308L18.0593 10.3025" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M21.1035 17.1383L21.4068 17.7558C21.5585 18.0591 21.9376 18.3408 22.2735 18.4058L22.6851 18.4708C23.9201 18.6766 24.2126 19.5866 23.3243 20.4858L22.9451 20.865C22.696 21.125 22.5552 21.6233 22.631 21.97L22.6851 22.1975C23.021 23.6925 22.2302 24.2666 20.9302 23.4866L20.6485 23.3241C20.3126 23.1291 19.771 23.1291 19.4351 23.3241L19.1535 23.4866C17.8426 24.2775 17.0518 23.6925 17.3985 22.1975L17.4526 21.97C17.5285 21.6233 17.3877 21.125 17.1385 20.865L16.7593 20.4858C15.871 19.5866 16.1635 18.6766 17.3985 18.4708L17.8101 18.4058C18.1351 18.3516 18.5251 18.0591 18.6768 17.7558L18.9801 17.1383C19.5651 15.9575 20.5185 15.9575 21.1035 17.1383Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>   
                ';
        
        $ico_system = '<svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 16.25C14.7949 16.25 16.25 14.7949 16.25 13C16.25 11.2051 14.7949 9.75 13 9.75C11.2051 9.75 9.75 11.2051 9.75 13C9.75 14.7949 11.2051 16.25 13 16.25Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2.1665 13.9532V12.0466C2.1665 10.9199 3.08734 9.98822 4.22484 9.98822C6.18567 9.98822 6.98734 8.60156 6.0015 6.90072C5.43817 5.92572 5.774 4.65822 6.75984 4.09489L8.634 3.02239C9.48984 2.51322 10.5948 2.81656 11.104 3.67239L11.2232 3.87822C12.1982 5.57906 13.8015 5.57906 14.7873 3.87822L14.9065 3.67239C15.4157 2.81656 16.5207 2.51322 17.3765 3.02239L19.2507 4.09489C20.2365 4.65822 20.5723 5.92572 20.009 6.90072C19.0232 8.60156 19.8248 9.98822 21.7857 9.98822C22.9123 9.98822 23.844 10.9091 23.844 12.0466V13.9532C23.844 15.0799 22.9232 16.0116 21.7857 16.0116C19.8248 16.0116 19.0232 17.3982 20.009 19.0991C20.5723 20.0849 20.2365 21.3416 19.2507 21.9049L17.3765 22.9774C16.5207 23.4866 15.4157 23.1832 14.9065 22.3274L14.7873 22.1216C13.8123 20.4207 12.209 20.4207 11.2232 22.1216L11.104 22.3274C10.5948 23.1832 9.48984 23.4866 8.634 22.9774L6.75984 21.9049C5.774 21.3416 5.43817 20.0741 6.0015 19.0991C6.98734 17.3982 6.18567 16.0116 4.22484 16.0116C3.08734 16.0116 2.1665 15.0799 2.1665 13.9532Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg> ';
        \Modules\Admin\Modul\Buildermenu::add_element(
            "/",                        //Родитель   
            "site",              //Название на латинице
            "Сайт " ,     //Название на Русском
            "site",              //Url адрес
            1,                          //Приоритет
            1,                          //TODO Вид действия
            $ico_site,                    //Иконка
            "admin"         //Привелегии
        );
        \Modules\Admin\Modul\Buildermenu::add_element(
            "/",                          
            "shop",              
            "Магазин " ,     
            "shop",              
            2,                          
            1,                          
            $ico_shop,                    
            "admin"         
        );
        \Modules\Admin\Modul\Buildermenu::add_element(
            "/",                          
            "crm",              
            "ЦРМ " ,     
            "crm",              
            3,                          
            1,                          
            $ico_crm,                    
            "admin"         
        );
        \Modules\Admin\Modul\Buildermenu::add_element(
            "/",                          
            "system",              
            "Система" ,     
            "system",              
            3,                          
            1,                          
            $ico_system,                    
            "admin"         
        );

        \Modules\Admin\Modul\Buildermenu::add_element(
            "system",                        //Родитель   
            "service",              //Название на латинице
            "Сервисы " ,     //Название на Русском
            "service",              //Url адрес
            99,                          //Приоритет
            1,                          //TODO Вид действия
            $ico_site,                    //Иконка
            "admin"         //Привелегии
        );
 
    }
}
