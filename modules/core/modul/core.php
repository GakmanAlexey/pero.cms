<?php

namespace Modules\Core\Modul;

class Core{
    public function __construct(){
        try {
            Env::load();
            if(Env::get("APP_DEBUG") == "true"){
                $this->APP_DEBUG_TRUE();
            }else{
                $this->APP_DEBUG_FALSE();
            }
            if(Env::get("APP_INSTALL") == "true"){
                \Modules\Core\Modul\Install::seach_files();
            } 
            //\Modules\Router\Modul\Loader::load_default_routes();
            session_start();
            $auth_token = new \Modules\User\Modul\Service;
            $auth_token->auth_to_cookie();
            \Modules\Router\Modul\Router::start();

$result = \Modules\Mail\Modul\Mail::send(
    'gakman@ya.ru',
    'Тестовое письмо',
    '<h1>Привет!</h1><p>Это тестовое письмо</p>'
);

if ($result['success']) {
    echo "Письмо отправлено!";
} else {
    echo "Ошибка: " . $result['message'];
}
            /*
            $result = $mailer->send(
                'gakman@ya.ru',
                'Тема письма',
                '<h1>Приветствие</h1><p>Это тестовое письмо</p>',
                true // HTML-письмо
            );

            var_dump($result );
            if (!$result['success']) {

                var_dump($result );
                // Обработка ошибки
            }
            var_dump($result );
/*

            $gp = new \Modules\Group\Modul\Group;
            $gp->set_name("test1");
            $gp->set_name_ru("тест1");
            $gp->set_prefix("[]");
            $gp->set_id(4);


            $us = new \Modules\User\Modul\User;
            $us->set_id(1);

            $serv = new \Modules\Group\Modul\Service;
            var_dump($serv->include($gp,$us));

            $gp = new \Modules\Group\Modul\Group;
            $gp->set_name("test1");
            $gp->set_name_ru("тест1");
            $gp->set_prefix("1");

            $serv = new \Modules\Group\Modul\Service;
            var_dump($serv->create($gp));
               



            $_POST["username"]="log";
            $_POST["password"]="11111111";
            $ver = new \Modules\User\Modul\Service;
            $ver -> unban();

            $ver = new \Modules\User\Modul\Service;
            $status = $ver->auth();
            var_dump($status,"<br><br><br>");
            var_dump($ver->msg);
            
            $_POST["username"]="log";
            $_POST["reason_ban"]="я так захотел";
            $_POST["expiry_ban"]=99999;

            $ver = new \Modules\User\Modul\Service;
            $ver -> ban();

            $_POST["username"]="log";
            $_POST["password"]="11111111";
            
            $ver = new \Modules\User\Modul\Service;
            $status = $ver->auth();
            var_dump($status,"<br><br><br>");
            var_dump($ver->msg);

            $_POST["username"]="log";
            $_POST["password"]="11111111";
            $ver = new \Modules\User\Modul\Service;
            $status = $ver->auth();
            var_dump($status,"<br><br><br>");
            var_dump($ver->msg);

            $_POST["username"]="log";
            $_POST["email"]="test@ya.ru";
            $_POST["password"]="11111111";
            $_POST["password2"]="11111111";
            $ver = new \Modules\User\Modul\Service;
            $status = $ver->register();
            var_dump($status,"<br><br><br>");
            var_dump($ver->msg);

            $config = \Modules\User\Modul\Config::get_instance();
            $errorMessage = $config->get_message('password_too_short', [
                'min_pass' => $config->get('limits->min_pass')
            ]);
            echo $errorMessage;
            
            $reg = new \Modules\User\Modul\Register();
            $reg ->set_user("jaligwei","galigwei@ya.ru","dsadasdasdasdas",true);
            $res = $reg ->register();
            var_dump($res);


            $builder = new \Modules\Router\Modul\Builder();
            // Собираем и объединяем маршруты
            $builder->start();   


            \Modules\Router\Modul\Loader::load_default_routes();
            var_dump(\Modules\Router\Modul\Collector::get_all_routes());
*/

        } catch (\Throwable $e) {
            $this->e500([
                'error_message' => $e->getMessage(),
                'exception' => $e
            ]);
        }
    }

    public function APP_DEBUG_TRUE(){
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        ini_set('log_errors', '1');
    }
    public function APP_DEBUG_FALSE(){
        ini_set('display_errors', '0');
        ini_set('display_startup_errors', '0');
        ini_set('log_errors', '1'); // Но логируем всегда
    }

    public function e500(array $context = []){
        \Modules\Router\Modul\Errorhandler::e500($context);
        exit;
    }
}