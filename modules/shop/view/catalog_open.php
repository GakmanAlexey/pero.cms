<?php
//var_dump($this->data_view["categor_list"]-> get_list_catalog());
?>
    <div class="win flex1">
        <div class="container">
            <h2 class="b023_title_block">
                <?php echo $this->data_view["categor_list"]->get_name_ru();?>
            </h2>   
            <div class="b023_kategori_box">
                
<?php
foreach($this->data_view["categor_list"]-> get_list_catalog() as $item_list_cat){
    $file = \Modules\Files\Modul\Taker:: take($item_list_cat->get_img());
    echo ' <a href="'.$item_list_cat->get_url_full().'" class="b023_kategori_item">
                    <img src="'.$file-> get_path().'" alt="">
                    <h4 class="b023_kategori_item_name">'.$item_list_cat->get_name_ru().'</h4>
                </a>
                ';}
?>
  
            </div>

        </div>
    </div>
