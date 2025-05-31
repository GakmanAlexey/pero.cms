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
                    <a href="/news/element" class="b012_news_item">
                        <img src="/photo.jpg" class="b012_news_item_img" alt="Новость 1">
                        <div class="b012_news_item_title">Pero.CMS интегрируется с новыми платёжными системами</div>
                        <div class="b012_news_item_text">Теперь пользователи смогут подключать более 10 провайдеров оплаты без написания кода...</div>
                        <div class="b012_news_item_date">28 мая 2025</div>
                    </a>

                    <a href="/news/element" class="b012_news_item">
                        <img src="/photo.jpg" class="b012_news_item_img" alt="Новость 2">
                        <div class="b012_news_item_title">Как повысить конверсию лендинга за 1 день с помощью Pero</div>
                        <div class="b012_news_item_text">Разбираем кейс с увеличением конверсии на 67% без редизайна и с минимальными усилиями...</div>
                        <div class="b012_news_item_date">27 мая 2025</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>