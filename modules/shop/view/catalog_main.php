<?php
//var_dump($this->data_view["categor_list"]);
?>
    <div class="win flex1">
        <div class="container">
            <h2 class="b022_title_block">
                Измерительный инструмент
            </h2>   
            <div class="b022_kategori_box">
<?php
foreach($this->data_view["categor_list"] as $catalog_item){
    $file = \Modules\Files\Modul\Taker:: take($catalog_item->get_img());
    echo '
                <a href="'.$catalog_item->get_url_full().'" class="b022_kategori_item">
                    <img src="'.$file-> get_path().'" alt="">
                    <h4 class="b022_kategori_item_name">'.$catalog_item->get_name_ru().'</h4>
                </a>
                ';
}
?>
               

               
            </div>

        </div>
    </div>