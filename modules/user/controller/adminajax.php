<?php

namespace Modules\User\Controller;

Class Adminajax extends \Modules\Abs\Controller{

    public function active(){   
        $this->verify("auth");
        $act = new \Modules\User\Modul\Ajax;
        $act->set_active($_GET["id"]);
    }
    public function noactive(){   
        $this->verify("auth");
        $act = new \Modules\User\Modul\Ajax;
        $act->set_noactive($_GET["id"]);
    }
    
}
