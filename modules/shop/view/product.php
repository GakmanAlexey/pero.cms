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
                    <img src="/src/img/image-6.png" alt="" id="b027_main_img">
                    </div>

                    <button class="b027_slider_arrow b027_next">
                    <!-- Правая стрелка SVG -->
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M9 6L15 12L9 18" stroke="#171717" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    </button>
                </div>

  <div class="b027_slider_thumbnails">
    <img src="/src/img/image-6.png" alt="" class="b027_thumb active" data-index="0">
    <img src="/src/img/image-7.png" alt="" class="b027_thumb" data-index="1">
    <img src="/src/img/image-8.png" alt="" class="b027_thumb" data-index="2">
  </div>
</div>



            <div class="b027_tovar_info">
                <div class="b027_tovar_info_box">
                    <div class="b027_title_block">
                        Стабилизаторы Бастион
                    </div>

                    <div class="b027_logo_company">
                        <img src="/src/img/Rectangle 122186.png" alt="">
                    </div>
                </div>

                <div class="b027_tovar_info_box b027_derect_col">
                    <div class="b027_tovar_info_box_price_box">
                        <div class="b027_tovar_info_box_price">156 000 ₽</div>
                        <div class="b027_tovar_info_box_old_price">264 000 ₽</div>
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
                        В наличии:  <div class="b027_slider__item_counter_numb"> 20 шт.</div> 
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
                    Стабилизатор напряжения настенного исполнения для квартиры, офиса. Мощность нагрузки — до 
                    5 кВА., 16 ступеней регулирования. Точность стабилизации — 3,5%. Рабочий диапазон напряжения сети — 120...280 В.
                    Расширенный диапазон напряжение сети — 80...295 В. 4 температурных датчика для защиты от перегрева. Тройная защита
                    от перегрузки. Микропроцессорное управление и «мягкое» переключение ступеней. Стабилизация вольтдобавочного типа 
                    на симисторных ключах с запасом по мощности. Цифровой дисплей отображает реальное напряжение, ток, мощность по входу 
                    и выходу. Конвективное охлаждение обеспечивают бесшумную работу стабилизатора.
                    Защитное отключение при аварийно низком/высоком напряжении с автоматическим восстановлением. Металлический корпус.
                </p>
            </div>

            <div class="b027_tovar_info">
                <p class="b027_tovar_info_box_title">
                    Характеристики
                </p>
                <table class="b027_custom-table">
                    <tr>
                        <td>Новинка</td>
                        <td>Нет</td>
                    </tr>
                    
                    <tr>
                        <td>Акции</td>
                        <td>Нет</td>
                    </tr>

                    <tr>
                        <td>Вид изделия</td>
                        <td>Стабилизатор напряжения</td>
                    </tr>

                    <tr>
                        <td>Производитель</td>
                        <td>Бастион</td>
                    </tr>

                    <tr>
                        <td>Ток нагрузки, А</td>
                        <td>не более 14А</td>
                    </tr>

                    <tr>
                        <td>Артикул</td>
                        <td>SE00090988</td>
                    </tr>

                    <tr>
                        <td>Спецпредложение</td>
                        <td>Нет</td>
                    </tr>

                    <tr>
                        <td>Габаритные размеры</td>
                        <td>310x240x485 мм</td>
                    </tr>

                    <tr>
                        <td>Мощность номинальная нагрузки</td>
                        <td>3000 ВА</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
  const images = [
    '/src/img/image-6.png',
    '/src/img/image-7.png',
    '/src/img/image-8.png'
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
