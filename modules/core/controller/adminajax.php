<?php

namespace Modules\Core\Controller;

Class Adminajax extends \Modules\Abs\Controller{

    public function css_admin(){   
        $this->verify("auth");        
        \Modules\Core\Modul\Css::merge_files_admin(false);
        $this->type_show = "ajax";
        $this->list_file[] = APP_ROOT."/modules/core/view/css_admin.php";
        $this->show();
    }
    
    public function css_default(){   
        $this->verify("auth");
        \Modules\Core\Modul\Css::merge_files_default(false);
        $this->type_show = "ajax";
        $this->list_file[] = APP_ROOT."/modules/core/view/css_default.php";
        $this->show();
    }
    
}
