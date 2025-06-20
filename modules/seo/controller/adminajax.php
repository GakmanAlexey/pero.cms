<?php

namespace Modules\Seo\Controller;

Class Adminajax extends \Modules\Abs\Controller{

    public function seo_admin(){   
        $this->verify("auth");   
        $mer = new \Modules\Seo\Modul\Marge;
        $this->data_view["count"] = $mer->admin_router();     
        $this->type_show = "ajax";
        $this->list_file[] = APP_ROOT."/modules/seo/view/admin/seo_admin.php";
        $this->show();
    }
    
    public function seo_default(){   
        $this->verify("auth");
        $mer = new \Modules\Seo\Modul\Marge;
        $this->data_view["count"] = $mer->default_router();  
        $this->type_show = "ajax";
        $this->list_file[] = APP_ROOT."/modules/seo/view/admin/seo_default.php";
        $this->show();
    }
    
}
