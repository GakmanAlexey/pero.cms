<?php

namespace Modules\User\Controller;

Class Index extends \Modules\Abs\Controller{

    public function login(){   
        $this->cashe_start();
        if($this->cache_isset) return ;
        \Modules\Core\Modul\Head::load();
        $this->type_show = "default";
        \Modules\Core\Modul\Resource::load_conf($this->type_show);        
        $this->list_file[] = APP_ROOT."/modules/user/view/login.php";
        $this->show();
        $this->cashe_end();
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
