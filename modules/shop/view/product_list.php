    <div class="b024_product_katalog">
        
<?php    

//var_dump($this->data_view["product_list"]);
foreach($this->data_view["product_list"]->get_list_product() as $product){

    //var_dump($product);
        $file = \Modules\Files\Modul\Taker:: take($product->get_main_image());
        if($product->get_status_filter()){
                $productId = $product->get_id();
                $variationId = 0;

    echo '
        <div class="b024_product_item">
            <a class="b024_product_item_link" href="'.$product->get_url_full().'">
            <div class="b024_product_item_img_box">
                <img src="'.$file->get_path().'" alt="">
            </div>

            <p class="b024_product_item_name">
               '.$product->get_name_ru().'
            </p>
            
            <div class="b024_product_item_counter">
                В наличии:  <div class="b024_product_item_counter_numb"> '.$product->get_currency().' шт.</div> 
            </div>
            </a>

            <div class="b024_product_item_wrap_bottom">
            <div class="b024_product_item_price_box">
                <p class="b024_product_item_price">'.$product->get_price().' ₽</p>
                <p class="b024_product_item_old_price">'.$product->get_old_price().' ₽</p>
            </div>
            <a class="b024_product_item_old_price_cart" 
            data-product-id="'. $productId.'" 
            data-variation-id="'.$variationId.'">
                <svg width="25" height="25" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="b024_product_item_old_price_cart_icon" d="M2.66675 2.66669H4.98676C6.42676 2.66669 7.56008 3.90669 7.44008 5.33335L6.33341 18.6133C6.14675 20.7867 7.86674 22.6533 10.0534 22.6533H24.2534C26.1734 22.6533 27.8534 21.08 28.0001 19.1734L28.7201 9.17336C28.8801 6.96003 27.2001 5.16001 24.9734 5.16001H7.76009" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path class="b024_product_item_old_price_cart_icon" d="M21.6667 29.3333C22.5871 29.3333 23.3333 28.5871 23.3333 27.6667C23.3333 26.7462 22.5871 26 21.6667 26C20.7462 26 20 26.7462 20 27.6667C20 28.5871 20.7462 29.3333 21.6667 29.3333Z" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path class="b024_product_item_old_price_cart_icon" d="M10.9999 29.3333C11.9204 29.3333 12.6666 28.5871 12.6666 27.6667C12.6666 26.7462 11.9204 26 10.9999 26C10.0794 26 9.33325 26.7462 9.33325 27.6667C9.33325 28.5871 10.0794 29.3333 10.9999 29.3333Z" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path class="b024_product_item_old_price_cart_icon" d="M12 10.6667H28" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>                                    
            </a>
            </div>
        </div>';}
        //var_dump($product->get_specific());

        if($product->get_variations() != []){
            foreach($product->get_variations() as $variant){
                    $productId = $product->get_id(); 
                        $variationId = $variant->get_id();
                if($variant->get_status_filter()){
                echo '
                <div class="b024_product_item">
                    <a class="b024_product_item_link" href="'.$product->get_url_full().'?variant='.$variant->get_id().'">
                    <div class="b024_product_item_img_box">
                        <img src="'.$file->get_path().'" alt="">
                    </div>
        
                    <p class="b024_product_item_name">
                       '.$variant->get_name().'
                    </p>
                    
                    <div class="b024_product_item_counter">
                        В наличии:  <div class="b024_product_item_counter_numb"> '.$variant->get_quantity().' шт.</div> 
                    </div>
                    </a>
        
                    <div class="b024_product_item_wrap_bottom">
                    <div class="b024_product_item_price_box">
                        <p class="b024_product_item_price">'.$variant->get_price().' ₽</p>
                        <p class="b024_product_item_old_price">'.$variant->get_old_price().' ₽</p>
                    </div>
                    
                    <a class="b024_product_item_old_price_cart" 
                    data-product-id="'. $productId.'" 
                    data-variation-id="'.$variationId.'">
                        <svg width="25" height="25" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="b024_product_item_old_price_cart_icon" d="M2.66675 2.66669H4.98676C6.42676 2.66669 7.56008 3.90669 7.44008 5.33335L6.33341 18.6133C6.14675 20.7867 7.86674 22.6533 10.0534 22.6533H24.2534C26.1734 22.6533 27.8534 21.08 28.0001 19.1734L28.7201 9.17336C28.8801 6.96003 27.2001 5.16001 24.9734 5.16001H7.76009" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path class="b024_product_item_old_price_cart_icon" d="M21.6667 29.3333C22.5871 29.3333 23.3333 28.5871 23.3333 27.6667C23.3333 26.7462 22.5871 26 21.6667 26C20.7462 26 20 26.7462 20 27.6667C20 28.5871 20.7462 29.3333 21.6667 29.3333Z" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path class="b024_product_item_old_price_cart_icon" d="M10.9999 29.3333C11.9204 29.3333 12.6666 28.5871 12.6666 27.6667C12.6666 26.7462 11.9204 26 10.9999 26C10.0794 26 9.33325 26.7462 9.33325 27.6667C9.33325 28.5871 10.0794 29.3333 10.9999 29.3333Z" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path class="b024_product_item_old_price_cart_icon" d="M12 10.6667H28" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                                    
                    </a>
                    </div>
                </div>';}
            }
        }
}
?>

    </div>
</div>
<script>
// Функция для показа уведомления (добавляем если нет)
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

// Функция для обновления количества в кнопке "Купить"
function updateBuyButtonQuantity(quantity) {
    const buyButton = document.querySelector('.b027_btn_form');
    if (buyButton) {
        buyButton.setAttribute('data-quantity', quantity);
    }
}

// Функция для добавления товара из списка (без счетчика количества)
function addToCartFromList(productId, variationId = null) {
    // Проверяем наличие productId
    if (!productId) {
        showCartNotification('Ошибка: ID товара не указан', 'error');
        return;
    }
    
    // Создаем параметры запроса (количество всегда 1)
    const params = new URLSearchParams({
        product_id: productId,
        quantity: 1
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

// Функция для добавления товара с выбором количества
function addToCartCustom(productId, variationId = null, quantity = 1) {
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

// Обработчики для иконок корзины в списках товаров
document.addEventListener('DOMContentLoaded', function() {
    // Обработчики для иконок корзины в списках
    const cartIcons = document.querySelectorAll('.b024_product_item_old_price_cart');
    
    cartIcons.forEach(icon => {
        icon.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Получаем данные из data-атрибутов
            const productId = this.getAttribute('data-product-id');
            const variationId = this.getAttribute('data-variation-id');
            
            // Вызываем функцию добавления в корзину
            addToCartFromList(productId, variationId);
        });
    });
    
    // Остальные обработчики (для счетчика и кнопки "Купить")
    const quantityInput = document.querySelector('.b027_quantity-input');
    const decrementBtn = document.querySelector('.b027_decrement');
    const incrementBtn = document.querySelector('.b027_increment');
    
    if (quantityInput && decrementBtn && incrementBtn) {
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
        
        // Обработчик для потери фокуса
        quantityInput.addEventListener('blur', function() {
            let value = parseInt(this.value) || 1;
            if (value < 1) value = 1;
            this.value = value;
            updateBuyButtonQuantity(value);
        });
    }
    
    // Обработчик для кнопок "Купить"
    const buttons = document.querySelectorAll('.b027_btn_form');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const productId = this.getAttribute('data-product-id');
            const variationId = this.getAttribute('data-variation-id');
            const quantity = this.getAttribute('data-quantity') || 1;
            
            addToCartCustom(productId, variationId, quantity);
        });
    });
});
</script>