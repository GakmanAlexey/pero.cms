<?php

namespace Modules\Shop\Modul;

class Brandmanager{
    private $brand;
    private $main_url = "brand";
    public function focus(\Modules\Shop\Modul\Brand $brand){
        $this->brand = $brand;
        return $this;
    }    

    public function view(){
        $viev = $this->brand->get_view_count() + 1;
        $this->brand->set_view_count($viev);
        return $this;
    }

    public function get_array(){
        return [
        'id' => $this->brand->get_id(),
        'name' => $this->brand->get_name(),
        'name_ru' => $this->brand->get_name_ru(),
        'description' => $this->brand->get_description(),
        'is_active' => $this->brand->get_is_active(),
        'create_at' => $this->brand->get_create_at(),
        'updated_at' => $this->brand->get_updated_at(),
        'code' => $this->brand->get_code(),
        'external_guid' => $this->brand->get_external_guid(),
        'url_full' => $this->brand->get_url_full(),
        'url_block' => $this->brand->get_url_block(),
        'img' => $this->brand->get_img(),
        'text' => $this->brand->get_text(),
        'sync_date' => $this->brand->get_sync_date(),
        'is_sync_with_1c' => $this->brand->get_is_sync_with_1c(),
        'external_code' => $this->brand->get_external_code(),
        'view_count' => $this->brand->get_view_count(),
        'product_count' => $this->brand->get_product_count()
        ];
    }

    public function select(){

    }

    public function create(\Modules\Shop\Modul\Brand $brand){

        $brand->set_name(\Modules\Core\Modul\Cleanstring::sanitize($brand->get_name_ru(), false, 240));
        $brand->set_url_block(\Modules\Core\Modul\Url::generate($brand->get_name(),"shop_brand" , "url_block"));
        $brand->set_url_full("/".$this->main_url."/".$brand->get_url_block()."/");

        
        $pdo = \Modules\Core\Modul\Sql::connect();
        try {
            $stmt = $pdo->prepare("
                INSERT INTO ".\Modules\Core\Modul\Env::get("DB_PREFIX")."shop_brand 
                (name, name_ru, description, is_active, url_full, 
                url_block , img,  text)
                VALUES (:name, :name_ru,  :description, :is_active, :url_full, 
                :url_block , :img,  :text)
            ");
            
            $params = [
                ':name' => $brand->get_name(), 
                ':name_ru' => $brand->get_name_ru(),  
                ':description' => $brand->get_description(), 
                ':is_active' => $brand->get_is_active(), 
                ':url_full' => $brand->get_url_full(), 
                ':url_block' => $brand->get_url_block(), 
                ':img' => $brand->get_img(), 
                ':text' => $brand->get_text()
            ];
            
            $stmt->execute($params);
            $brand->set_id($pdo->lastInsertId());
            if($brand->get_id() >= 1){
                $router = new \Modules\Router\Modul\Manager;
                $router->create($brand->get_url_full(),"\Modules\Shop\Controller\Brand","open");
    
                $page = new \Modules\Seo\Modul\Page;
                $page->set_url($brand->get_url_full())
                    -> set_title($brand->get_name_ru())
                    -> set_description($brand->get_name_ru())
                    -> set_name($brand->get_name_ru())
                    -> set_keys($brand->get_name_ru());
    
                $builder = new \Modules\Router\Modul\Builder();                
                $builder->start();
                
                return [
                    'job' => true,
                    'status' => true,
                    'id' => $brand->get_id(),
                    'msg' => 'Сохранено'
                ];    
            }
            
            return [
                'job' => true,
                'status' => false,
                'id' => 0,
                'msg' => 'Ошибка сохранения'
            ];   
        } catch (\PDOException $e) {
           echo $e->getMessage();
        }
        return [
            'job' => true,
            'status' => false,
            'id' => 0,
            'msg' => 'Ошибка сохранения '
        ];    
    }

    public function update(){
        
    }

    public function delete(){
        
    }
    
}