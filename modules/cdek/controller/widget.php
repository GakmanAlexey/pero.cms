<?php

namespace Modules\Cdek\Controller;

Class Widget extends \Modules\Abs\Controller{

    public function start(){   
        $this->type_show = "ajax";
        $this->list_file[] = APP_ROOT."/modules/cdek/view/widget.php";
        $this->show();
    }

    public function test(){   
        $this->type_show = "ajax";
        $this->list_file[] = APP_ROOT."/modules/cdek/view/widgettest.php";
        $this->show();
    }
    
}
