<?php

$service = new \Modules\Cdek\Modul\Servicewidget(
    /**
     * Вставьте свой аккаунт\идентификатор для интеграции
     * Put your account for integration here cdek-login
     */ 'wqGwiQx0gg8mLtiEKsUinjVSICCjtTEP',

    /**
     * Вставьте свой пароль для интеграции
     * Put your password for integration here cdek-pass
     */ 'RmAmgvSgSl1yirlz9QupbzOJVqhCxcP5');
     
$service->process($_GET, file_get_contents('php://input'));
?>