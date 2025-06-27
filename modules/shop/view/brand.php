
    <div class="win flex1">
        <div class="container">
           
            <div class="b022_brand_box">
                <h2 class="b022_brand_title">
                    <?php echo $this->data_view->get_name_ru();?>
                </h2>
                <div class="b022_brand_img">
                    <?php

$file = \Modules\Files\Modul\Taker:: take($this->data_view->get_img());
                    ?>
                    <img src="<?php echo $file->get_path();?>" alt="">
                </div>
                <p class="b022_brand_text"><?php echo $this->data_view->get_text();?></p>
            </div>
        </div>
    </div> 