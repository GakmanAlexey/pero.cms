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
                    <!-- Карточки новостей -->
                    <a href="/news/element" class="b011_news_card">
                        <img src="/photo.jpg" class="b011_news_image" alt="Новость 1">
                        <div class="b011_news_title_inner">Заголовок интересной новости о разработке</div>
                        <div class="b011_news_excerpt">Здесь будет краткое описание статьи, которое занимает не более четырех строк. Оно помогает понять, о чём новость.  чём новость. чём новость. чём новость. чём новость.</div>
                        <div class="b011_news_date">28 мая 2025</div>
                    </a>
                    <a href="/news/element" class="b011_news_card">
                        <img src="/photo.jpg" class="b011_news_image" alt="Новость 2">
                        <div class="b011_news_title_inner">Важное обновление на платформе Pero.CMS</div>
                        <div class="b011_news_excerpt">Новая функциональность доступна для всех пользователей. Улучшена безопасность, добавлены полезные инструменты.</div>
                        <div class="b011_news_date">27 мая 2025</div>
                    </a>
                    <a href="/news/element" class="b011_news_card">
                        <img src="/photo.jpg" class="b011_news_image" alt="Новость 3">
                        <div class="b011_news_title_inner">Расширение команды и запуск нового проекта</div>
                        <div class="b011_news_excerpt">В нашей команде пополнение! А также стартует новый крупный проект для муниципальных учреждений и малого бизнеса.</div>
                        <div class="b011_news_date">25 мая 2025</div>
                    </a>
                    <a href="/news/element" class="b011_news_card">
                        <img src="/photo.jpg" class="b011_news_image" alt="Новость 4">
                        <div class="b011_news_title_inner">Pero.CMS на выставке веб-технологий</div>
                        <div class="b011_news_excerpt">Мы приняли участие в крупнейшей выставке, посвященной современному вебу, где презентовали наш движок и поделились опытом.</div>
                        <div class="b011_news_date">24 мая 2025</div>
                    </a>

                    <a href="/news/element" class="b011_news_card">
                        <img src="/photo.jpg" class="b011_news_image" alt="Новость 4">
                        <div class="b011_news_title_inner">Pero.CMS на выставке веб-технологий</div>
                        <div class="b011_news_excerpt">Мы приняли участие в крупнейшей выставке, посвященной современному вебу, где презентовали наш движок и поделились опытом.</div>
                        <div class="b011_news_date">24 мая 2025</div>
                    </a>
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