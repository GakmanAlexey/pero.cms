<?php

?>
<div class="b010_news_page full_height_wrapper">
    <div class="container">
        <h1 class="b010_page_title">Новости</h1>

        <div class="b010_tabs_wrapper">
            <?php
foreach($this->data_view["cat_list"]  as $item_cat){
    // <div class="b010_tab b010_tab_active">Все</div>
    echo '<a class="b010_tab"  href="'.$item_cat-> get_full_url().'">'.$item_cat-> get_name_ru().'</a>';
}
            ?>
        </div>

        <div class="b010_news_grid">
            <?php
foreach($this->data_view["news_list"] as $item_news){

    echo '
            <a href="'.$item_news->get_full_url().'" class="b010_news_card">
                <img src=" '.$item_news->get_main_img().'" alt="Фото '.$item_news->get_name_ru().'" class="b010_news_image">
                <div class="b010_news_title">'.$item_news->get_name_ru().'</div>
                <div class="b010_news_excerpt">
                    '.$item_news->get_description().'
                </div>
                <div class="b010_news_date">'. $item_news->get_publish_date_ru().'</div>
            </a>
            ';
}
            ?>

            
        </div>
    </div>
</div>