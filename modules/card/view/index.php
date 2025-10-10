<div class="win flex1">
    <div class="container">
        <div class="b030_title_block">
            Оформление заказа
        </div>
    </div>
    <?php

// ТЕСТ СОХРАНЕНИЯ И ЗАГРУЗКИ КОРЗИНЫ С ВАРИАЦИЯМИ
echo "=== ТЕСТ СОХРАНЕНИЯ И ЗАГРУЗКИ КОРЗИНЫ ===\n\n";

// Загружаем корзину
$cm = new \Modules\Card\Modul\Cardmeneger;
$cm::load();
$card = $cm::$card;

// Создаем оператор для работы с корзиной
$oper = new \Modules\Card\Modul\Cardoperationvar;

// Очищаем корзину перед тестом
$card->set_product_list([]);
echo "Корзина очищена\n";

// ТЕСТ 1: Добавляем товар 1 с вариацией 1
echo "1. Добавляем товар 1 с вариацией 1:\n";
$product1_var1 = new \Modules\Shop\Modul\Product;
$product1_var1->set_id(1);
$product1_var1->set_name("Товар 1");

$variation1 = new \Modules\Shop\Modul\Variation;
$variation1->set_id(1);
$product1_var1->set_variations([$variation1]);

$oper->addToCart($card, $product1_var1, 2);
echo "   Добавлен: товар 1, вариация 1, количество 2\n";
echo "   В корзине: " . ($oper->isProductInCart($card, $product1_var1) ? "Да" : "Нет") . "\n";

// ТЕСТ 2: Добавляем товар 3 с вариацией 4
echo "2. Добавляем товар 3 с вариацией 4:\n";
$product3_var4 = new \Modules\Shop\Modul\Product;
$product3_var4->set_id(3);
$product3_var4->set_name("Товар 3");

$variation4 = new \Modules\Shop\Modul\Variation;
$variation4->set_id(4);
$product3_var4->set_variations([$variation4]);

$oper->addToCart($card, $product3_var4, 1);
echo "   Добавлен: товар 3, вариация 4, количество 1\n";
echo "   В корзине: " . ($oper->isProductInCart($card, $product3_var4) ? "Да" : "Нет") . "\n";

// ТЕСТ 3: Добавляем товар без вариаций
echo "3. Добавляем товар без вариаций:\n";
$product5_no_var = new \Modules\Shop\Modul\Product;
$product5_no_var->set_id(5);
$product5_no_var->set_name("Товар 5 без вариаций");

$oper->addToCart($card, $product5_no_var, 3);
echo "   Добавлен: товар 5, без вариаций, количество 3\n";
echo "   В корзине: " . ($oper->isProductInCart($card, $product5_no_var) ? "Да" : "Нет") . "\n";

// ПРОСТОЙ ВЫВОД КОРЗИНЫ ДО СОХРАНЕНИЯ
echo "\n=== КОРЗИНА ДО СОХРАНЕНИЯ (простой вывод) ===\n";
$productList = $card->get_product_list();
echo "Количество товаров в корзине: " . count($productList) . "\n";

foreach ($productList as $index => $cartProduct) {
    echo "Товар " . ($index + 1) . ": ID=" . $cartProduct->get_id() . 
         ", Количество=" . $cartProduct->get_count_buy_in_card() . "\n";
    
    $variations = $cartProduct->get_variations();
    if (!empty($variations)) {
        echo "  Вариации: ";
        foreach ($variations as $variant) {
            if ($variant instanceof \Modules\Shop\Modul\Variation) {
                echo $variant->get_id() . " ";
            }
        }
        echo "\n";
    } else {
        echo "  Вариации: нет\n";
    }
}

// СОХРАНЯЕМ КОРЗИНУ
echo "\n4. Сохраняем корзину...\n";
$saveCard = new \Modules\Card\Modul\Cardsave;
$saveResult = $saveCard->save($card);
echo "   Результат сохранения: " . ($saveResult['success'] ? 'УСПЕХ' : 'ОШИБКА') . "\n";
echo "   Сообщение: " . $saveResult['new_status'] . "\n";

// ПРОВЕРЯЕМ ДАННЫЕ В БАЗЕ
echo "\n5. Проверяем данные в БД...\n";
$pdo = \Modules\Core\Modul\Sql::connect();
$stmt = $pdo->prepare("SELECT product_list FROM " . \Modules\Core\Modul\Env::get("DB_PREFIX") . "shop_card WHERE id = ?");
$stmt->execute([$card->get_id()]);
$data = $stmt->fetch(\PDO::FETCH_ASSOC);

if ($data && !empty($data['product_list'])) {
    echo "   Данные в БД получены\n";
    $unserialized = unserialize($data['product_list']);
    echo "   Формат данных: ";
    if (is_array($unserialized) && !empty($unserialized) && isset($unserialized[0]['product_id'])) {
        echo "НОВЫЙ (с вариациями)\n";
        echo "   Сохраненные товары:\n";
        foreach ($unserialized as $item) {
            echo "     - ID: " . $item['product_id'] . ", Количество: " . $item['quantity'];
            if (!empty($item['variations'])) {
                echo ", Вариации: " . implode(', ', $item['variations']);
            }
            echo "\n";
        }
    } else {
        echo "СТАРЫЙ (без вариаций)\n";
    }
} else {
    echo "   Данные в БД не найдены или пустые\n";
}

// ЗАГРУЗКА КОРЗИНЫ ЗАНОВО
echo "\n6. Загружаем корзину заново...\n";
$cm2 = new \Modules\Card\Modul\Cardmeneger;
$cm2::load();
$cardReloaded = $cm2::$card;

// ПРОСТОЙ ВЫВОД КОРЗИНЫ ПОСЛЕ ЗАГРУЗКИ
echo "\n=== КОРЗИНА ПОСЛЕ ЗАГРУЗКИ ===\n";
$productListReloaded = $cardReloaded->get_product_list();
echo "Количество товаров в корзине: " . count($productListReloaded) . "\n";

foreach ($productListReloaded as $index => $cartProduct) {
    echo "Товар " . ($index + 1) . ": ID=" . $cartProduct->get_id() . 
         ", Количество=" . $cartProduct->get_count_buy_in_card() . "\n";
    
    $variations = $cartProduct->get_variations();
    if (!empty($variations)) {
        echo "  Вариации: ";
        foreach ($variations as $variant) {
            if ($variant instanceof \Modules\Shop\Modul\Variation) {
                echo $variant->get_id() . " ";
            }
        }
        echo "\n";
    } else {
        echo "  Вариации: нет\n";
    }
}

// ПРОВЕРКА ЦЕЛОСТНОСТИ
echo "\n7. Проверка целостности данных:\n";
echo "   Товар 1 с вариацией 1: " . ($oper->isProductInCart($cardReloaded, $product1_var1) ? "Найден ✓" : "Не найден ✗") . "\n";
echo "   Товар 3 с вариацией 4: " . ($oper->isProductInCart($cardReloaded, $product3_var4) ? "Найден ✓" : "Не найден ✗") . "\n";
echo "   Товар 5 без вариаций: " . ($oper->isProductInCart($cardReloaded, $product5_no_var) ? "Найден ✓" : "Не найден ✗") . "\n";

echo "\n=== ТЕСТ ЗАВЕРШЕН ===\n";

?>
    <div class="container">
        <div class="b030_oplata_box">
            <div class="b030_wrap_oplata col_5">
                <form action="">
                    <div class="b030_wrap_info">
                        <div class="b005_input_wrapper">
                            <input class="b005_input" type="text" placeholder="ФИО" name="client">
                            <div class="b005_error_message"></div>
                        </div>
                         <div class="b005_input_wrapper">
                            <input class="b005_input" type="text" placeholder="Телефон" name="phone">
                            <div class="b005_error_message"></div>
                        </div>
                         <div class="b005_input_wrapper">
                            <input class="b005_input" type="text" placeholder="E-mail" name="mail">
                            <div class="b005_error_message"></div>
                        </div>
                    </div>
                    <div class="b030_parent_sposoby">
                        <div class="b030_wrap_sposoby">
                            <p class="b030_opis_radio">Выберите способ доставки </p>
                            <div class="b030_form_wrapper">
                                <label class="b030_radio_parent" style="background-image: url(/modules/card/src/img/sdek.svg);" for="huey">
                                        <input class="radio" type="radio" id="huey" name="drone1" value="huey" checked />
                                </label>  

                                <label class="b030_radio_parent" style="background-image: url(/modules/card/src/img/porf.svg);" for="hue1y">
                                        <input class="radio" type="radio" id="hue1y" name="drone1" value="huey"  />
                                </label>  
                            </div>
                        </div>
                        
                        <div class="b030_wrap_sposoby">
                            <p class="b030_opis_radio">Выберите способ оплаты </p>
                            <div class="b030_form_wrapper">
                                <label class="b030_radio_parent" style="background-image: url(/modules/card/src/img/sbp.svg);" for="hue22y">
                                        <input class="radio" type="radio" id="hue22y" name="drone2" value="huey2" checked />
                                </label>  

                                <label class="b030_radio_parent" style="background-image: url(/modules/card/src/img/bank.svg);" for="hue11y">
                                        <input class="radio" type="radio" id="hue11y" name="drone2" value="huey2"  />
                                </label>  
                            </div>
                        </div>
                    </div>
                    <div class="b030_all_price">
                        <div class="b030_all_price_row">
                            <div class="b030_all_price_row_element">
                                Стоимость
                            </div>
                            <div class="line">

                            </div>
                            <div class="b030_all_price_row_element">
                                200₽
                            </div>
                        </div>
                        <div class="b030_all_price_row">
                            <div class="b030_all_price_row_element">
                                Скидка
                            </div>
                            
                            <div class="b030_line">
                                
                            </div>
                            <div class="b030_all_price_row_element">
                                100₽
                            </div>
                        </div>
                        
                        <div class="b030_all_price_row">
                            <div class="b030_all_price_row_element b030_itog_pay">
                                К оплате
                            </div>
                            
                            <div class="b030_line">
                                
                            </div>
                            <div class="b030_all_price_row_element b030_itog_pay">
                                100₽
                            </div>
                        </div>
                        <button class="b030_btn_form btn">Оплатить</button>
                    </div>
                </form>
            </div>
            
           <div class="b030_wrap_oplata col_6">
                    <div class="b030_no_tovar">
                        <div class="b030_empty_cart_notification">
                            <p>Ваша корзина пуста</p>
                            <button class="b030_catalog_button">Перейти в каталог</button>
                        </div>
                    </div>
                    <div class="b030_oplata_tovar">
                        <div class="b030_oplata_tovar_image">
                            <img src="src/img/image-11.png" alt="">
                        </div>
                            <div class="b030_oplata_tovar_center_wrap">
                                <div class="b030_oplata_tovar_name">Стабилизаторы Бастион</div>
                                <a href="" class="b030_delite_tovar">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.5 4.98332C14.725 4.70832 11.9333 4.56665 9.15 4.56665C7.5 4.56665 5.85 4.64998 4.2 4.81665L2.5 4.98332" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.0835 4.14163L7.26683 3.04996C7.40016 2.25829 7.50016 1.66663 8.9085 1.66663H11.0918C12.5002 1.66663 12.6085 2.29163 12.7335 3.05829L12.9168 4.14163" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15.7082 7.6167L15.1665 16.0084C15.0748 17.3167 14.9998 18.3334 12.6748 18.3334H7.32484C4.99984 18.3334 4.92484 17.3167 4.83317 16.0084L4.2915 7.6167" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8.6084 13.75H11.3834" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.9165 10.4166H12.0832" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Удалить
                                </a>
                            </div>
                            <div class="b030_oplata_tovar_price_numb">
                                <div class="b030_oplata_tovar_card_price_box">
                                    <div class="b030_oplata_tovar_card_price">
                                        100 ₽
                                    </div>
                                    <div class="b030_oplata_tovar_card_old_price">
                                        200 ₽
                                    </div>
                                </div>
        
                                <div class="b030_oplata_tovar_numb">
                                        <div class="b030_oplata_tovar_numb_by_box_conter b030_tovar_info_box_by_box_conter">
                                            <button class="b030_quantity-btn b030_decrement b030_oplata_tovar_numb_by_box_conter_quantity_btn">-</button>
                                            <input type="text" class="b030_quantity-input b030_oplata_tovar_numb_by_box_conter_quantity_input" value="1">
                                            <button class="b030_quantity-btn b030_increment b030_oplata_tovar_numb_by_box_conter_quantity_btn">+</button>
                                        </div>
                                </div>
                            </div>        
                    </div>
                    <div class="b030_oplata_tovar">
                        <div class="b030_oplata_tovar_image">
                            <img src="src/img/image-11.png" alt="">
                        </div>
                            <div class="b030_oplata_tovar_center_wrap">
                                <div class="b030_oplata_tovar_name">Стабилизаторы Бастион</div>
                                <a href="" class="b030_delite_tovar">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.5 4.98332C14.725 4.70832 11.9333 4.56665 9.15 4.56665C7.5 4.56665 5.85 4.64998 4.2 4.81665L2.5 4.98332" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.0835 4.14163L7.26683 3.04996C7.40016 2.25829 7.50016 1.66663 8.9085 1.66663H11.0918C12.5002 1.66663 12.6085 2.29163 12.7335 3.05829L12.9168 4.14163" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15.7082 7.6167L15.1665 16.0084C15.0748 17.3167 14.9998 18.3334 12.6748 18.3334H7.32484C4.99984 18.3334 4.92484 17.3167 4.83317 16.0084L4.2915 7.6167" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8.6084 13.75H11.3834" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.9165 10.4166H12.0832" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Удалить
                                </a>
                            </div>
                            <div class="b030_oplata_tovar_price_numb">
                                <div class="b030_oplata_tovar_card_price_box">
                                    <div class="b030_oplata_tovar_card_price">
                                        100 ₽
                                    </div>
                                    <div class="b030_oplata_tovar_card_old_price">
                                        200 ₽
                                    </div>
                                </div>
        
                                <div class="b030_oplata_tovar_numb">
                                        <div class="b030_oplata_tovar_numb_by_box_conter b030_tovar_info_box_by_box_conter">
                                            <button class="b030_quantity-btn b030_decrement b030_oplata_tovar_numb_by_box_conter_quantity_btn">-</button>
                                            <input type="text" class="b030_quantity-input b030_oplata_tovar_numb_by_box_conter_quantity_input" value="1">
                                            <button class="b030_quantity-btn b030_increment b030_oplata_tovar_numb_by_box_conter_quantity_btn">+</button>
                                        </div>
                                </div>
                            </div>        
                    </div>
                    <div class="b030_oplata_tovar">
                        <div class="b030_oplata_tovar_image">
                            <img src="src/img/image-11.png" alt="">
                        </div>
                            <div class="b030_oplata_tovar_center_wrap">
                                <div class="b030_oplata_tovar_name">Стабилизаторы Бастион</div>
                                <a href="" class="b030_delite_tovar">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.5 4.98332C14.725 4.70832 11.9333 4.56665 9.15 4.56665C7.5 4.56665 5.85 4.64998 4.2 4.81665L2.5 4.98332" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.0835 4.14163L7.26683 3.04996C7.40016 2.25829 7.50016 1.66663 8.9085 1.66663H11.0918C12.5002 1.66663 12.6085 2.29163 12.7335 3.05829L12.9168 4.14163" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15.7082 7.6167L15.1665 16.0084C15.0748 17.3167 14.9998 18.3334 12.6748 18.3334H7.32484C4.99984 18.3334 4.92484 17.3167 4.83317 16.0084L4.2915 7.6167" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8.6084 13.75H11.3834" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.9165 10.4166H12.0832" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Удалить
                                </a>
                            </div>
                            <div class="b030_oplata_tovar_price_numb">
                                <div class="b030_oplata_tovar_card_price_box">
                                    <div class="b030_oplata_tovar_card_price">
                                        100 ₽
                                    </div>
                                    <div class="b030_oplata_tovar_card_old_price">
                                        200 ₽
                                    </div>
                                </div>
        
                                <div class="b030_oplata_tovar_numb">
                                        <div class="b030_oplata_tovar_numb_by_box_conter b030_tovar_info_box_by_box_conter">
                                            <button class="b030_quantity-btn b030_decrement b030_oplata_tovar_numb_by_box_conter_quantity_btn">-</button>
                                            <input type="text" class="b030_quantity-input b030_oplata_tovar_numb_by_box_conter_quantity_input" value="1">
                                            <button class="b030_quantity-btn b030_increment b030_oplata_tovar_numb_by_box_conter_quantity_btn">+</button>
                                        </div>
                                </div>
                            </div>        
                    </div>
                    <div class="b030_oplata_tovar">
                        <div class="b030_oplata_tovar_image">
                            <img src="src/img/image-11.png" alt="">
                        </div>
                            <div class="b030_oplata_tovar_center_wrap">
                                <div class="b030_oplata_tovar_name">Стабилизаторы Бастион</div>
                                <a href="" class="b030_delite_tovar">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.5 4.98332C14.725 4.70832 11.9333 4.56665 9.15 4.56665C7.5 4.56665 5.85 4.64998 4.2 4.81665L2.5 4.98332" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.0835 4.14163L7.26683 3.04996C7.40016 2.25829 7.50016 1.66663 8.9085 1.66663H11.0918C12.5002 1.66663 12.6085 2.29163 12.7335 3.05829L12.9168 4.14163" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15.7082 7.6167L15.1665 16.0084C15.0748 17.3167 14.9998 18.3334 12.6748 18.3334H7.32484C4.99984 18.3334 4.92484 17.3167 4.83317 16.0084L4.2915 7.6167" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8.6084 13.75H11.3834" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M7.9165 10.4166H12.0832" stroke="#979797" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Удалить
                                </a>
                            </div>
                            <div class="b030_oplata_tovar_price_numb">
                                <div class="b030_oplata_tovar_card_price_box">
                                    <div class="b030_oplata_tovar_card_price">
                                        100 ₽
                                    </div>
                                    <div class="b030_oplata_tovar_card_old_price">
                                        200 ₽
                                    </div>
                                </div>
        
                                <div class="b030_oplata_tovar_numb">
                                        <div class="b030_oplata_tovar_numb_by_box_conter b030_tovar_info_box_by_box_conter">
                                            <button class="b030_quantity-btn b030_decrement b030_oplata_tovar_numb_by_box_conter_quantity_btn">-</button>
                                            <input type="text" class="b030_quantity-input b030_oplata_tovar_numb_by_box_conter_quantity_input" value="1">
                                            <button class="b030_quantity-btn b030_increment b030_oplata_tovar_numb_by_box_conter_quantity_btn">+</button>
                                        </div>
                                </div>
                            </div>        
                    </div>

                    
                </div>
        </div>
    </div>
</div>