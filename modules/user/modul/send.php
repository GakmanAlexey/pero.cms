<?php

namespace Modules\User\Modul;
use \Modules\User\Modul\User;
class Send{
   

    public function login(){
        $telegram = new \Modules\Telegram\Modul\Telegram(\Modules\Core\Modul\Env::get("TG_KEY") );
        $telegram->select_chat(\Modules\Core\Modul\Env::get("TG_CHAT") ) ;
        $result = $telegram->send_message('Пользователь аторизовался! id:'. \Modules\User\Modul\Msg::$id );
    }
    public function register(){
        $telegram = new \Modules\Telegram\Modul\Telegram(\Modules\Core\Modul\Env::get("TG_KEY") );
        $telegram->select_chat(\Modules\Core\Modul\Env::get("TG_CHAT") ) ;
        $result = $telegram->send_message('Зарегестрировался новый пользователь! id:'. \Modules\User\Modul\Msg::$id." login: ". \Modules\User\Modul\Msg::$login." email: ".\Modules\User\Modul\Msg::$email );
$msg = '
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Подтверждение почты</title>
</head>
<body style="margin:0; padding:0; background-color:#F0F0F0;">
  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color:#F0F0F0;">
    <tr>
      <td align="center">
        
        <table role="presentation" cellpadding="0" cellspacing="0" width="600" style="width:600px; margin:0 auto; background-color:#F0F0F0;">
          <tr>
            <td style="padding: 20px 20px 0 20px;">
              
              <div class="m001_logo" style="font-family: Arial, sans-serif; font-size: 16px; color: #999999; text-align: left;">
                logo.png
              </div>
            </td>
          </tr>
          <tr>
            <td style="padding: 20px;">
              
              <div class="m001_white_block" style="background-color:#ffffff; border-radius:10px; padding: 20px; font-family: Arial, sans-serif; color:#000000; text-align: left;">
                
                
                <h1 class="m001_title" style="font-size: 20px; margin: 0 0 15px 0;">Подтвердите адрес электронной почты</h1>

                
                <p class="m001_text" style="font-size: 15px; line-height: 1.5; margin: 0 0 20px 0;">
                  Для завершения регистрации на сервисе <strong>Pero.CMS</strong>, пожалуйста, нажмите на кнопку ниже. Это поможет нам убедиться, что именно вы являетесь владельцем указанного адреса электронной почты.
                </p>

                
                <div class="m001_warning" style="background-color: #FFF4E5; border-left: 4px solid #FFA500; padding: 10px 15px; font-size: 14px; margin-bottom: 20px;">
                  <strong>Внимание:</strong> если это были не вы, проигнорируйте данное сообщение.
                </div>

                
                <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td class="m001_button" style="background-color:#2F6BF2; padding:7px 26px; border-radius:5px; text-align: center;">
                      <a href="'.\Modules\Core\Modul\Env::get("APP_URL") .'/user/verify-email/?key='.\Modules\User\Modul\Msg::$token_reg .'" style="color:#ffffff; font-size:14px; font-family: Arial, sans-serif; text-decoration:none; display:inline-block;">Подтвердить почту</a>
                    </td>
                  </tr>
                </table>

              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>

';    
        $result = \Modules\Mail\Modul\Mail::send(
    \Modules\User\Modul\Msg::$email,
    'Регистрация на сайте '.\Modules\Core\Modul\Env::get("APP_URL"),
    $msg
);
    
    }

    public function recover(){
        $telegram = new \Modules\Telegram\Modul\Telegram(\Modules\Core\Modul\Env::get("TG_KEY") );
        $telegram->select_chat(\Modules\Core\Modul\Env::get("TG_CHAT") ) ;
        $result = $telegram->send_message('Пользователь начал востановления пароля! id:'. \Modules\User\Modul\Msg::$id." login: ". \Modules\User\Modul\Msg::$login." email: ".\Modules\User\Modul\Msg::$email );

        $msg = '
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Подтверждение почты</title>
</head>
<body style="margin:0; padding:0; background-color:#F0F0F0;">
  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color:#F0F0F0;">
    <tr>
      <td align="center">
        
        <table role="presentation" cellpadding="0" cellspacing="0" width="600" style="width:600px; margin:0 auto; background-color:#F0F0F0;">
          <tr>
            <td style="padding: 20px 20px 0 20px;">
              
              <div class="m001_logo" style="font-family: Arial, sans-serif; font-size: 16px; color: #999999; text-align: left;">
                logo.png
              </div>
            </td>
          </tr>
          <tr>
            <td style="padding: 20px;">
              
              <div class="m001_white_block" style="background-color:#ffffff; border-radius:10px; padding: 20px; font-family: Arial, sans-serif; color:#000000; text-align: left;">
                
                
                <h1 class="m001_title" style="font-size: 20px; margin: 0 0 15px 0;">Востановление паполя</h1>

                
                <p class="m001_text" style="font-size: 15px; line-height: 1.5; margin: 0 0 20px 0;">
                  Для сброса пароля нажмите на кнопку ниже. Это подтвердит, что запрос на восстановление отправлен именно вами.
                </p>

                
                <div class="m001_warning" style="background-color: #FFF4E5; border-left: 4px solid #FFA500; padding: 10px 15px; font-size: 14px; margin-bottom: 20px;">
                  <strong>Внимание:</strong> если это были не вы, проигнорируйте данное сообщение.
                </div>

                
                <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td class="m001_button" style="background-color:#2F6BF2; padding:7px 26px; border-radius:5px; text-align: center;">
                      <a href="'.\Modules\Core\Modul\Env::get("APP_URL") .'/user/recover/step2/?key='.\Modules\User\Modul\Msg::$token_reg .'" style="color:#ffffff; font-size:14px; font-family: Arial, sans-serif; text-decoration:none; display:inline-block;">Востановить пароль</a>
                    </td>
                  </tr>
                </table>

              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>

';  
        $result = \Modules\Mail\Modul\Mail::send(
    \Modules\User\Modul\Msg::$email,
    'Востановление пароля на сайте '.\Modules\Core\Modul\Env::get("APP_URL"),
    $msg
);
    
    }
    
}

    
