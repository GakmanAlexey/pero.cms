<?php

namespace Modules\Router\Controller;

Class Adminajax extends \Modules\Abs\Controller{

    public function start(){   
        $this->verify("auth");   
        
        $builder = new \Modules\Router\Modul\Builder();                
        $builder->start();
        $this->type_show = "ajax";
        $this->list_file[] = APP_ROOT."/modules/router/view/admin/start.php";
        $this->show();
    }
    
}
