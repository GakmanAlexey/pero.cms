<?php

namespace Modules\Card\Controller;

Class Ajax extends \Modules\Abs\Controller{
    public function add(){   
        $this->type_show = "ajax";
        $this->list_file[] = APP_ROOT."/modules/card/view/ajax/add.php";
        $this->show();
    }
    public function remove(){   
        $this->type_show = "ajax";
        $this->list_file[] = APP_ROOT."/modules/card/view/ajax/remove.php";
        $this->show();
    }
    public function delete(){   
        $this->type_show = "ajax";
        $this->list_file[] = APP_ROOT."/modules/card/view/ajax/delete.php";
        $this->show();
    }
    public function count(){   //готово
        $this->type_show = "ajax";        
        $cardAjax =  new \Modules\Card\Modul\Cardajax;
        $this->data_view["countData"] = $cardAjax->viewCountProduct();
        $this->list_file[] = APP_ROOT."/modules/card/view/ajax/count.php";
        $this->show();
    }
    public function price(){   
        $this->type_show = "ajax";
        $this->list_file[] = APP_ROOT."/modules/card/view/ajax/price.php";
        $this->show();
    }
    public function info(){   
        $this->type_show = "ajax";
        $this->list_file[] = APP_ROOT."/modules/card/view/ajax/info.php";
        $this->show();
    }
    
}
