<?php
namespace Modules\Mail\Modul;

class Mail {
    public static function send(string $to, string $subject, string $body) {
        $mail = new Message(true);
        $cfg = new \Modules\Mail\Modul\Config();

        try {

            $mail->SMTPDebug = SMTP::DEBUG_OFF;                    
            $mail->isSMTP();                                            
            $mail->Host       = $cfg->get_host();                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = $cfg->get_username();                     
            $mail->Password   = $cfg->get_password();                                
            $mail->SMTPSecure = Message::ENCRYPTION_SMTPS;           
            $mail->Port       = $cfg->get_port();  

            $mail->setFrom($cfg->get_from_email(), $cfg->get_from_name());
            $mail->addAddress($to);  
            $mail->isHTML(true); 
            $mail->Subject = $subject;
            $mail->Body    =  $body;
            $mail->send();
            return ['success' => true, 'message' => 'Email sent successfully'];
        
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
