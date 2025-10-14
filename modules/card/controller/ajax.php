<?php

namespace Modules\Card\Controller;

Class Ajax extends \Modules\Abs\Controller{
    
    public function add(){   
        $this->type_show = "ajax";
        
        $productId = $_GET['product_id'] ?? null;
        $variationId = $_GET['variation_id'] ?? null;
        $quantity = $_GET['quantity'] ?? 1;
        
        $cardAjax = new \Modules\Card\Modul\Cardajax;
        $result = $cardAjax->addToCart($productId, $variationId, $quantity);
        
        // Устанавливаем заголовок JSON и выводим результат
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    
    public function remove(){   
        $this->type_show = "ajax";        
        $productId = $_GET['product_id'] ?? null;
        $variationId = $_GET['variation_id'] ?? null;
        $quantity = $_GET['quantity'] ?? 1;        
        $cardAjax = new \Modules\Card\Modul\Cardajax;
        $result = $cardAjax->removeFromCart($productId, $variationId, $quantity);        
        $this->data_view["result"] = $result;
        $this->list_file[] = APP_ROOT."/modules/card/view/ajax/remove.php";
        $this->show();
    }
    
    public function delete(){   
        $this->type_show = "ajax";        
        $productId = $_GET['product_id'] ?? null;
        $variationId = $_GET['variation_id'] ?? null;        
        $cardAjax = new \Modules\Card\Modul\Cardajax;
        $result = $cardAjax->deleteFromCart($productId, $variationId);
        
        $this->data_view["result"] = $result;
        $this->list_file[] = APP_ROOT."/modules/card/view/ajax/delete.php";
        $this->show();
    }
    
    public function count(){   
        $this->type_show = "ajax";        
        $cardAjax = new \Modules\Card\Modul\Cardajax;
        $this->data_view["countData"] = $cardAjax->viewCountProduct();
        $this->list_file[] = APP_ROOT."/modules/card/view/ajax/count.php";
        $this->show();
    }
    
    public function price(){   
        $this->type_show = "ajax";
        
        $cardAjax = new \Modules\Card\Modul\Cardajax;
        $this->data_view["priceData"] = $cardAjax->getPriceInfo();
        
        $this->list_file[] = APP_ROOT."/modules/card/view/ajax/price.php";
        $this->show();
    }
    
    public function info(){   
        $this->type_show = "ajax";
        
        $cardAjax = new \Modules\Card\Modul\Cardajax;
        $this->data_view["cartInfo"] = $cardAjax->getCartInfo();
        
        $this->list_file[] = APP_ROOT."/modules/card/view/ajax/info.php";
        $this->show();
    }
    
    public function update_quantity(){   
        $this->type_show = "ajax";
        
        $productId = $_GET['product_id'] ?? null;
        $quantity = $_GET['quantity'] ?? 1;
        
        $variationId = null;
        if (isset($_GET['variation_id']) && $_GET['variation_id'] !== '') {
            $variationId = $_GET['variation_id'];
        }
        
        $cardAjax = new \Modules\Card\Modul\Cardajax;
        $result = $cardAjax->updateQuantity($productId, $variationId, $quantity);
        
        $this->data_view["result"] = $result;
        $this->list_file[] = APP_ROOT."/modules/card/view/ajax/update_quantity.php";
        $this->show();
    }
}