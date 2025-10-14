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
<?php 
$productId = $this->data_view["product"]->get_id();
$variant = $this->data_view["product"]->get_variations();
if (!empty($variations)) {
    $variationId = $variations[0]->get_id();
}else{
    $variationId = 0;
}
?>                        
                        <a class="b027_btn_form" 
                            data-product-id="<?php echo $productId;?>" 
                            data-variation-id="<?php echo $variationId;?>" 
                            data-quantity="1">
                            Купить
                        </a>
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

<script>function addToCartCustom(productId, variationId = null, quantity = 1) {
    // Проверяем наличие productId
    if (!productId) {
        showCartNotification('Ошибка: ID товара не указан', 'error');
        return;
    }
    
    // Создаем параметры запроса
    const params = new URLSearchParams({
        product_id: productId,
        quantity: quantity
    });
    
    // Добавляем variation_id если он есть и не равен 0
    if (variationId && variationId !== '0') {
        params.append('variation_id', variationId);
    }
    
    const url = `/ajax/card/add/?${params.toString()}`;
    
    // Отправляем AJAX запрос
    fetch(url, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        showCartNotification('Товар добавлен в корзину!');
        // Обновляем счетчик корзины после успешного добавления
        updateCartCount();
    })
    .catch(error => {
        showCartNotification('Ошибка при добавлении товара', 'error');
    });
}

// Функция для обновления счетчика корзины
function updateCartCount() {
    fetch('/ajax/card/count/', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success && data.cart_count !== undefined) {
            // Обновляем все элементы с счетчиком корзины
            const counterElements = document.querySelectorAll('.nomber_cart');
            counterElements.forEach(element => {
                element.textContent = data.cart_count;
            });
        }
    })
    .catch(error => {
        console.error('Ошибка при обновлении счетчика корзины:', error);
    });
}

// Функция для показа уведомления
function showCartNotification(message, type = 'success') {
    // Создаем элемент уведомления
    const notification = document.createElement('div');
    notification.className = `cart-notification ${type}`;
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        background: ${type === 'success' ? '#4CAF50' : '#f44336'};
        color: white;
        border-radius: 4px;
        z-index: 1000;
        animation: slideIn 0.3s ease;
    `;
    
    document.body.appendChild(notification);
    
    // Удаляем уведомление через 3 секунды
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Функция для обновления количества в кнопке "Купить"
function updateBuyButtonQuantity(quantity) {
    const buyButton = document.querySelector('.b027_btn_form');
    if (buyButton) {
        buyButton.setAttribute('data-quantity', quantity);
    }
}

// Обработчики для счетчика количества
document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.querySelector('.b027_quantity-input');
    const decrementBtn = document.querySelector('.b027_decrement');
    const incrementBtn = document.querySelector('.b027_increment');
    
    if (!quantityInput || !decrementBtn || !incrementBtn) return;
    
    // Обработчик для уменьшения количества
    decrementBtn.addEventListener('click', function() {
        let currentValue = parseInt(quantityInput.value) || 1;
        if (currentValue > 1) {
            currentValue--;
            quantityInput.value = currentValue;
            updateBuyButtonQuantity(currentValue);
        }
    });
    
    // Обработчик для увеличения количества
    incrementBtn.addEventListener('click', function() {
        let currentValue = parseInt(quantityInput.value) || 1;
        currentValue++;
        quantityInput.value = currentValue;
        updateBuyButtonQuantity(currentValue);
    });
    
    // Обработчик для ручного ввода
    quantityInput.addEventListener('input', function() {
        let value = parseInt(this.value) || 1;
        if (value < 1) value = 1;
        this.value = value;
        updateBuyButtonQuantity(value);
    });
    
    // Обработчик для потери фокуса (если ввели не число)
    quantityInput.addEventListener('blur', function() {
        let value = parseInt(this.value) || 1;
        if (value < 1) value = 1;
        this.value = value;
        updateBuyButtonQuantity(value);
    });
    
    // ОДИН обработчик для кнопок "Купить" (без дублирования)
    const buttons = document.querySelectorAll('.b027_btn_form');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Получаем актуальное количество из data-атрибута
            const productId = this.getAttribute('data-product-id');
            const variationId = this.getAttribute('data-variation-id');
            const quantity = this.getAttribute('data-quantity') || 1;
            
            // Вызываем функцию добавления в корзину
            addToCartCustom(productId, variationId, quantity);
        });
    });
});


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
