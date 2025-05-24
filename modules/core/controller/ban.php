<?php

namespace Modules\Core\Controller;

Class Ban extends \Modules\Abs\Controller{
    public function index(){      
          
        $this->type_show = "errors";
        $this->list_file[] = APP_ROOT."/modules/core/view/ban.php";
        $this->show();
        die();
    }

}
