<?php

namespace Modules\License\Modul;

class License 
{
    public static function get_effective_date() {
        return "15 марта 2024 года";
    }
    
    public static function get_site_name() {
        return "Интернет-магазин Перо";
    }
    
    public static function get_admin_contact() {
        return "ООО 'Перо' (ИНН 1234567890)";
    }
    
    public static function get_legal_address() {
        return "123456, Россия, г. ИТ Москва, ул. Техническая, д. 9999, офис 999999";
    }
    
    public static function get_min_age() {
        return 18;
    }
    
    public static function get_collected_data_types() {
        return "имя, электронная почта, телефон, адрес доставки, данные платежной карты (для оформления заказов), технические данные устройства (IP, cookies)";
    }
    
    public static function get_data_processing_purposes() {
        return "обработка заказов, предоставление услуг, маркетинговые коммуникации, улучшение качества сервиса";
    }
    
    public static function get_data_retention_period() {
        return "5 лет с момента последней активности или до отзыва согласия пользователем";
    }
    
    public static function get_disclaimer() {
        return "убытки, возникшие вследствие использования или невозможности использования сайта, включая упущенную выгоду";
    }
    
    public static function get_support_email() {
        return "legal@pero.example.com";
    }
    
    public static function get_support_phone() {
        return "+7 (495) 123-45-67";
    }
}