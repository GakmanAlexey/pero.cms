    <div class="win blok_margin100">
        <div class="container">
            <h2 class="title_block">
                Бренды
            </h2>

            <div class="b020_brand_box_wrap">
                <div class="b020_brand_box" id="brandBox">
                    <a href="#" class="b020_brand_elem">
                        <img src="/src/img/Rectangle 122186.png" alt="Brand 1">
                    </a>
                    <a href="#" class="b020_brand_elem">
                        <img src="/src/img/image-6.png" alt="Brand 2">
                    </a>
                    <a href="#" class="b020_brand_elem">
                        <img src="/src/img/image-7.png" alt="Brand 3">
                    </a>
                    <a href="#" class="b020_brand_elem">
                        <img src="/src/img/image-8.png" alt="Brand 4">
                    </a>
                     <a href="#" class="b020_brand_elem">
                        <img src="/src/img/image-7.png" alt="Brand 3">
                    </a>
                    <a href="#" class="b020_brand_elem">
                        <img src="/src/img/image-7.png" alt="Brand 3">
                    </a>
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const brandBox = document.getElementById('brandBox');
    const brandElems = brandBox.querySelectorAll('.b020_brand_elem');
    const brandCount = brandElems.length;

    // Прокрутка включается только если карточек больше 5
    if (brandCount <= 5) {
        // Центрируем контент, если карточек мало
        brandBox.style.justifyContent = 'center';
        return;
    }

    let isPaused = false;
    const duration = 20 * 1000; // Общая длительность цикла
    const step = brandBox.scrollWidth / duration; // Пикселей за миллисекунду
    const preloadOffset = 60; // Насколько раньше переставлять карточку

    // Запускаем анимацию
    function loop() {
        if (!isPaused) {
            const currentTransform = parseFloat(getComputedStyle(brandBox).transform.split(',')[4]) || 0;
            const newTransform = currentTransform - step * 16; // 16ms ≈ 1 кадр

            brandBox.style.transform = `translateX(${newTransform}px)`;

            const firstElement = brandBox.children[0];
            const elementWidth = firstElement.offsetWidth + 20; // 20 — это gap между карточками

            if (Math.abs(newTransform) >= elementWidth - preloadOffset) {
                brandBox.style.transition = 'none'; // Убираем анимацию перед перемещением
                brandBox.appendChild(firstElement); // Перемещаем первый элемент в конец
                brandBox.style.transform = `translateX(${newTransform + elementWidth}px)`; // Компенсируем сдвиг

                // Возвращаем плавность на следующий кадр
                requestAnimationFrame(() => {
                    brandBox.style.transition = 'transform 0.1s linear';
                });
            }
        }

        requestAnimationFrame(loop);
    }

    // Старт
    requestAnimationFrame(loop);

    // Наведение — пауза
    brandBox.addEventListener('mouseenter', () => {
        isPaused = true;
    });

    // Убрали мышь — прокрутка продолжается
    brandBox.addEventListener('mouseleave', () => {
        isPaused = false;
    });
});

</script>