<?php

namespace Modules\User\Controller;

Class Index extends \Modules\Abs\Controller{

    public function login(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show); 
        if(isset($_SESSION["id"]) and $_SESSION["id"] >= 1){
            $e401 = new \Modules\Core\Controller\E401;
            $e401->index();
                exit; 
        }
        if(isset($_POST["auth_button"])){
            $auth = new \Modules\User\Modul\Service;
            $status= $auth->auth(); 
            \Modules\User\Modul\Msg::include($status,$auth->msg,$auth->type);
            if($status){
                header("Location: /user/login/success/");
                exit; 
            }
        }
        $this->list_file[] = APP_ROOT."/modules/user/view/login.php";
        $this->show();
        $this->cashe_end();
    }
    public function logout(){   
        $auth = new \Modules\User\Modul\Service;
        $status= $auth->logout(); 
        header("Location: /user/login/");
    }
    public function login_success(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);        
        $this->list_file[] = APP_ROOT."/modules/user/view/loginsuccess.php";
        $this->show();
        $this->cashe_end();
    }
    
    public function register(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);        
        $this->list_file[] = APP_ROOT."/modules/user/view/register.php";
        $this->show();
        $this->cashe_end();
    }
    
    public function register_success(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);        
        $this->list_file[] = APP_ROOT."/modules/user/view/registersuccess.php";
        $this->show();
        $this->cashe_end();
    }
    
    public function verify_success(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);        
        $this->list_file[] = APP_ROOT."/modules/user/view/verifysuccess.php";
        $this->show();
        $this->cashe_end();
    }
    
    public function verify_failure(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);        
        $this->list_file[] = APP_ROOT."/modules/user/view/verifyfailure.php";
        $this->show();
        $this->cashe_end();
    }

}
