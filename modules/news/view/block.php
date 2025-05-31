<div class="b011_news full_height_wrapper">
    <div class="container">
        <div class="b011_news_section">
            <div class="b011_news_header">
                <h2 class="b011_news_title">Новости</h2>
                <a href="#" class="b011_news_button">Смотреть все новости</a>
            </div>

            <div class="b011_news_carousel_wrapper">
                <button class="b011_news_arrow b011_arrow_left" id="b011_arrow_left" hidden>&larr;</button>
                <div class="b011_news_carousel" id="b011_news_carousel">
                    <?php
                    foreach($this->data_view["carusel"] as $item_news){
echo '
                    <a href="'.$item_news->get_full_url().'" class="b011_news_card">
                        <img src="'.$item_news->get_main_img().'" class="b011_news_image" alt="Фото '.$item_news->get_name_ru().'">
                        <div class="b011_news_title_inner">'.$item_news->get_name_ru().'</div>
                        <div class="b011_news_excerpt">'.$item_news->get_description().'</div>
                        <div class="b011_news_date">'.$item_news->get_publish_date_ru().'</div>
                    </a>';
                    }
                    ?>

                </div>
                <button class="b011_news_arrow b011_arrow_right" id="b011_arrow_right" hidden>&rarr;</button>
            </div>
        </div>
    </div>
</div>



<script>
  const carousel = document.getElementById('b011_news_carousel');
  const leftArrow = document.getElementById('b011_arrow_left');
  const rightArrow = document.getElementById('b011_arrow_right');

  function updateArrows() {
    const cardCount = carousel.querySelectorAll('.b011_news_card').length;
    if (cardCount <= 3) {
      leftArrow.hidden = true;
      rightArrow.hidden = true;
    } else {
      leftArrow.hidden = false;
      rightArrow.hidden = false;
    }
  }

  leftArrow.addEventListener('click', () => {
    carousel.scrollBy({ left: -carousel.offsetWidth / 3, behavior: 'smooth' });
  });

  rightArrow.addEventListener('click', () => {
    carousel.scrollBy({ left: carousel.offsetWidth / 3, behavior: 'smooth' });
  });

  updateArrows();
</script>