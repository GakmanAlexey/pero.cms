

    <div class="b001_footer flex">
        <div class="container">
            <div class="b001_footer_box">
                <div class="b001_footer_logo_box">
                    <img src="src/img/logowh.svg" alt="">
                </div>
                <div class="b001_footer_link_box">
                    <a href="" class="b001_footer_link_item">
                        ©2023 Gakman
                    </a>
                    <a href="" class="b001_footer_link_item">
                        Политика конфиденциальности
                    </a>
                    <a href="" class="b001_footer_link_item">
                        Разработка сайта: GAKMAN
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Функция для обновления счетчика корзины
function updateCartCounter() {
    fetch('/ajax/card/count/')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Обновляем счетчик в DOM
                const counterElement = document.querySelector('.nomber_cart');
                if (counterElement) {
                    counterElement.textContent = data.cart_count;
                    
                    // Скрываем счетчик если товаров 0
                    if (data.cart_count === 0) {
                        counterElement.style.display = 'none';
                    } else {
                        counterElement.style.display = 'flex';
                    }
                }
            }
        })
        .catch(error => {
            console.error('Ошибка при обновлении счетчика корзины:', error);
            // Можно показать значение по умолчанию при ошибке
            document.querySelector('.nomber_cart').textContent = '0';
        });
}

// Обновляем счетчик при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
    updateCartCounter();
});

// Функция для добавления товара в корзину (пример)
function addToCart(productId, quantity = 1) {
    // Ваш код добавления товара...
    
    // После успешного добавления обновляем счетчик
    updateCartCounter();
}

// Функция для удаления товара из корзины
function removeFromCart(productId) {
    // Ваш код удаления товара...
    
    // После удаления обновляем счетчик
    updateCartCounter();
}

// Обновляем счетчик каждые 60 секунд (опционально)
setInterval(updateCartCounter, 60000);
</script>
