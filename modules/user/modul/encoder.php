<?php

namespace Modules\User\Modul;

class Encoder{
    private string $algorithm = PASSWORD_BCRYPT;
    private array $options = ['cost' => 12];

    public function hash($password){
        return password_hash($password, $this->algorithm, $this->options);
    }

    public function verify($password, $hash){
        return password_verify($password, $hash);
    }

    public function create_token($length = 40) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $result = '';
    
        for ($i = 0; $i < $length; $i++) {
            $result .= $characters[random_int(0, $charactersLength - 1)];
        }
    
        return $result;
    }
}

    
