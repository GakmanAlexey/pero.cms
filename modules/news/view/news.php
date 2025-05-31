<div class="b011_news full_height_wrapper">
    <div class="container">
        <div class="b012_news_page_wrapper">

            <!-- Статья -->
            <div class="b012_news_card">
                <h1 class="b012_news_title"><?php echo $this->data_view["news"]->get_name_ru();?></h1>

                <img src="<?php echo $this->data_view["news"]->get_main_img();?>" alt="Фото <?php echo $this->data_view["news"]->get_name_ru();?>" class="b012_news_image">

                <?php echo $this->data_view["news"]->get_text();?>  

                <div class="b012_news_footer">
                <?php echo $this->data_view["news"]->get_publish_date_ru();?>  • Автор: 
                <?php 
                $author =$this->data_view["news"]->get_author();
                echo $author["username"];
                ?>
                </div>
            </div>

            <!-- Похожие новости -->
            <div class="b012_news_related">
                <h2 class="b012_news_related_title">Похожие новости</h2>

                <div class="b012_news_grid">
                    <?php
foreach($this->data_view["news2"] as $leter_news){
    echo '          <a href="'.$leter_news->get_full_url().'" class="b012_news_item">
                        <img src="'.$leter_news->get_main_img().'" class="b012_news_item_img" alt="фото '.$leter_news->get_full_url().'">
                        <div class="b012_news_item_title">'.$leter_news->get_name_ru().'</div>
                        <div class="b012_news_item_text">'.$leter_news->get_description().'</div>
                        <div class="b012_news_item_date">'.$leter_news->get_publish_date_ru().'</div>
                    </a>';
}
                    ?>
                   

                   
                </div>
            </div>
        </div>
    </div>
</div>