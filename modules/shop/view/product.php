<?php
//var_dump($this->data_view["product"]);
$file = \Modules\Files\Modul\Taker:: take($this->data_view["product"]->get_main_image());
$file_brand = \Modules\Files\Modul\Taker:: take($this->data_view["brand"]->get_img());

?>


<div class="b027_win">
    <div class="сontainer">
        <div class="b027_tovar">
            <div class="b027_tovar_slider">
                <div class="b027_slider_main">
                    <button class="b027_slider_arrow b027_prev">
                    <!-- Левая стрелка SVG -->
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M15 18L9 12L15 6" stroke="#171717" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    </button>

                    <div class="b027_tovar_image_box">
                    <img src="<?php echo $file->get_path(); ?>" alt="" id="b027_main_img">
                    </div>

                    <button class="b027_slider_arrow b027_next">
                    <!-- Правая стрелка SVG -->
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M9 6L15 12L9 18" stroke="#171717" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    </button>
                </div>

  <div class="b027_slider_thumbnails">
    <?php
    $x = 1;
    echo '<img src="'.$file->get_path().'" alt="" class="b027_thumb" data-index="'.$x.'">';
foreach($this->data_view["product"]->get_images() as $img){
    
   $file2 = \Modules\Files\Modul\Taker::take($img);
   echo '<img src="'.$file2->get_path().'" alt="" class="b027_thumb" data-index="'.$x.'">';
   $x++;
}
    ?>
    
  </div>
</div>



            <div class="b027_tovar_info">
                <div class="b027_tovar_info_box">
                    <div class="b027_title_block">
                    <?php echo $this->data_view["product"]->get_name_ru();?>
                    </div>

                    <a class="b027_logo_company" href ="<?php echo $this->data_view["brand"]->get_url_full();?>"> 
                        <img src="<?php echo $file_brand->get_path();?>" alt="">
</a>
                </div>

                <div class="b027_tovar_info_box b027_derect_col">
                    <div class="b027_tovar_info_box_price_box">
                        <div class="b027_tovar_info_box_price"><?php echo $this->data_view["product"]->get_price();?> ₽</div>
                        <div class="b027_tovar_info_box_old_price"><?php echo $this->data_view["product"]->get_old_price();?> ₽</div>
                    </div>

                    <div class="b027_tovar_info_box_by_box">
                        <div class="b027_tovar_info_box_by_box_conter">
                            <button class="b027_quantity-btn b027_decrement">-</button>
                            <input type="text" class="b027_quantity-input" value="1">
                            <button class="b027_quantity-btn b027_increment">+</button>
                        </div>
                        <a href="#" class="b027_btn_form">Купить</a>
                    </div>
                </div>
                <div class="b027_tovar_info_box b027_margin_min">
                    <div class="b027_slider__item_counter b027_tovar_info_box_counter">
                        В наличии:  <div class="b027_slider__item_counter_numb"> <?php echo $this->data_view["product"]->get_currency();?> шт.</div> 
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="b027_win">
    <div class="container">
        <div class="b027_tovar_information_container">
            <div class="b027_tovar_info">
                <p class="b027_tovar_info_box_title">
                    Описание
                </p>
                <p class="b027_tovar_info_box_text">
                    <?php echo $this->data_view["product"]->get_description();?>
                </p>
            </div>

            <div class="b027_tovar_info">
                <p class="b027_tovar_info_box_title">
                    Характеристики
                </p>
                <table class="b027_custom-table">
                    <?php
foreach($this->data_view["product"]->get_specific()->get_specific() as $item_spec){
    if( $item_spec[7] == 1){
        echo '      <tr>
                        <td>'.$item_spec[3].'</td>
                        <td>'.$item_spec[4].' '.$item_spec[5].'</td>
                    </tr>';
    }
}
                    ?>
                    
                    
                    
                </table>
            </div>
        </div>
    </div>
</div>

<script>
  const images = [
    '<?php echo $file->get_path();?>'
    <?php
    $x = 1;
   
foreach($this->data_view["product"]->get_images() as $img){    
   $file2 = \Modules\Files\Modul\Taker::take($img);
   echo ',
   \''.$file2->get_path().'\'';
   $x++;
}
    ?>
  ];

  let currentIndex = 0;
  const mainImg = document.getElementById('b027_main_img');
  const thumbnails = document.querySelectorAll('.b027_thumb');

  function updateSlider(index) {
    currentIndex = index;
    mainImg.src = images[currentIndex];
    thumbnails.forEach((thumb, i) => {
      thumb.classList.toggle('active', i === currentIndex);
    });
  }

  document.querySelector('.b027_prev').addEventListener('click', () => {
    const newIndex = (currentIndex - 1 + images.length) % images.length;
    updateSlider(newIndex);
  });

  document.querySelector('.b027_next').addEventListener('click', () => {
    const newIndex = (currentIndex + 1) % images.length;
    updateSlider(newIndex);
  });

  thumbnails.forEach((thumb, index) => {
    thumb.addEventListener('click', () => updateSlider(index));
  });
</script>
