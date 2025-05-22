<?php

namespace Modules\Telegram\Modul;

class Telegram{
    private $bot_token;
    private $chat_id;
    
    public function __construct($bot_token) {
        $this->bot_token = $bot_token;
    }

    public function select_chat($chat_id) {
        $this->chat_id = $chat_id;
    }

    public function send_message($message, $parseMode = 'HTML') {
        $url = "https://api.telegram.org/bot{$this->bot_token}/sendMessage";
        
        $data = [
            'chat_id' => $this->chat_id,
            'text' => $message,
            'parse_mode' => $parseMode,
            'disable_web_page_preview' => true
        ];
        
        return $this->send_request($url, $data);
    }

    public function send_document($filePath, $caption = '') {
        $fullPath = APP_ROOT . DS . $filePath;
        
        if (!file_exists($fullPath)) {
            throw new \Exception("Файл не найден: " . $fullPath);
        }
        
        $url = "https://api.telegram.org/bot{$this->bot_token}/sendDocument";
        $data = [
            'chat_id' => $this->chat_id,
            'caption' => $caption,
            'document' => new \CURLFile(realpath($fullPath))
        ];
        
        return $this->send_request($url, $data);
    }

    public function send_photo($photoPath, $caption = '') {
        $photoPath = APP_ROOT . DS . $photoPath;

        if (!file_exists($photoPath)) {
            throw new \Exception("Файл не найден: " . $fullPath);
        }

        $url = "https://api.telegram.org/bot{$this->bot_token}/sendPhoto";
        
        $data = [
            'chat_id' => $this->chat_id,
            'caption' => $caption,
            'photo' => new \CURLFile(realpath($photoPath))
        ];
        
        return $this->send_request($url, $data);
    }

    private function send_request($url, $data) {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: multipart/form-data'
        ]);
        
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            throw new \Exception('Curl error: ' . curl_error($ch));
        }
        
        curl_close($ch);
        
        return json_decode($response, true);
    }
    
}