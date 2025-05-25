<?php

namespace Modules\Core\Controller;

Class E401 extends \Modules\Abs\Controller{
    public function index(){      
          
        \Modules\Core\Modul\Head::load();
        \Modules\Core\Modul\Resource::load_conf($this->type_show);
        $this->type_show = "errors";
        $this->list_file[] = APP_ROOT."/modules/core/view/e401.php";
        $this->show();
    }

}
