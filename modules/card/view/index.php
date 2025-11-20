<script src="https://cdn.jsdelivr.net/npm/@cdek-it/widget@3" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/@unocss/runtime" type="text/javascript"></script>
  <link href="https://cdn.jsdelivr.net/npm/@unocss/reset/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/jquery" type="text/javascript"></script>
  <div class="win flex1">
    <div class="container">
        <div class="b030_title_block">
            Оформление заказа
        </div>
    </div>
    <?php

$showCard = new \Modules\Card\Modul\Cardshow;
$card = $showCard-> cardLoad();
$cdek = new \Modules\Cdek\Modul\Cdek;
//var_dump("<pre>",$card,"</pre>");
$desk_data =$cdek->calculatePackageDimensions($card);
//var_dump("<pre>",$cdek->calculatePackageDimensions($card),"</pre>");
?>


  <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', () => {
          window.widget = new window.CDEKWidget({
                                                    apiKey: '<?php echo \Modules\Core\Modul\Env::get("YA_API_MAP");?>',
                                                    servicePath: '/api/cdek/widget/',
                                                    popup: true,
                                                    defaultLocation: 'Краснодар',
                                                    from: 'Краснодар',
                                                    goods: [ // установим данные о товарах из корзины
                                                        { length: <?php echo $desk_data["length"];?>, width: <?php echo $desk_data["width"];?>, height: <?php echo $desk_data["height"];?>, weight: <?php echo $desk_data["weight"];?> },
                                                    ],
                                                    hideDeliveryOptions: {
                                                        door: true,
                                                    },
                                                    onReady: function() { // на загрузку виджета отобразим информацию о доставке до ПВЗ
                                                        $('#linkForWidjet').css('display', 'inline');
                                                    },
                                                    onChoose: function(_type, tariff, address) { // при выборе ПВЗ: запишем номер ПВЗ в текстовое поле и доп. информацию
                                                        $('[name="chosenPost"]').val(address.name);
                                                        $('[name="addresPost"]').val(address.address);
                                                        $('[name="pricePost"]').val(tariff.delivery_sum);
                                                        $('[name="timePost"]').val(tariff.period_max);
                                                        this.close(); // закроем виджет
                                                    },
                                                });
      });
  </script>
    <div class="container">
        <div class="b030_oplata_box">
            <div class="b030_wrap_oplata col_5">
                <form action="/card/pay/"  method="post">
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
                                <label class="b030_radio_parent" style="background-image: url(/modules/card/src/img/sdek.svg);" for="huey" onclick="window.widget.open()">
                                        <input class="radio" type="radio" id="huey" name="drone1" value="cdek"  />
                                </label>  

                                <label class="b030_radio_parent" style="background-image: url(/modules/card/src/img/porf.svg);" for="hue1y" onclick="widjet.open()">
                                        <input class="radio" type="radio" id="hue1y" name="drone1" value="other"  />
                                </label> 
                                 
                            </div>
                            <div id="linkForWidjet" class="hidden"><br><br>
                                <p>Выбран пункт выдачи заказов: <input disabled name="chosenPost" type="text" value="" class="b005_input"/></p>
                                <p>Адрес пункта: <input disabled name="addresPost" type="text" value="" class="b005_input"/></p>
                                <p>Стоимость доставки: <input disabled name="pricePost" type="text" value="" class="b005_input"/></p>
                                <p>Примерные сроки доставки (дней): <input disabled name="timePost" type="text" value="" class="b005_input" /></p>
                            </div>
                        </div>
                        
                        <div class="b030_wrap_sposoby">
                            <p class="b030_opis_radio">Выберите способ оплаты </p>
                            <div class="b030_form_wrapper">
                                <label class="b030_radio_parent" style="background-image: url(/modules/card/src/img/sbp.svg);" for="hue22y">
                                        <input class="radio" type="radio" id="hue22y" name="drone2" value="cbp" checked />
                                </label>  

                                <label class="b030_radio_parent" style="background-image: url(/modules/card/src/img/bank.svg);" for="hue11y">
                                        <input class="radio" type="radio" id="hue11y" name="drone2" value="bank"  />
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
                                <?php echo $card->get_old_price();?>₽
                            </div>
                        </div>
                        <div class="b030_all_price_row">
                            <div class="b030_all_price_row_element">
                                Скидка
                            </div>
                            
                            <div class="b030_line">
                                
                            </div>
                            <div class="b030_all_price_row_element">
                                 <?php echo $card->get_discount();?>₽
                            </div>
                        </div>
                        <div class="b030_all_price_row">
                            <div class="b030_all_price_row_element">
                                Доставка
                            </div>
                            
                            <div class="b030_line">
                                
                            </div>
                            <div class="b030_all_price_row_element" id="price_dost">
                                 0₽
                            </div>
                        </div>
                        
                        <div class="b030_all_price_row">
                            <div class="b030_all_price_row_element b030_itog_pay">
                                К оплате
                            </div>
                            
                            <div class="b030_line">
                                
                            </div>
                            <div class="b030_all_price_row_element b030_itog_pay" id="total_price_end">
                                <?php echo $card->get_price();?>₽
                            </div>
                            <div class="b030_all_price_row_element b030_itog_pay" id="total_price" style="display:none;">
                                <?php echo $card->get_price();?>
                            </div>
                        </div>
                        <button class="b030_btn_form btn">Оплатить</button>
                    </div>
                </form>
            </div>
            
           <div class="b030_wrap_oplata col_6">
                    
<?php
$count_prod = 0;
foreach($card->get_product_list() as $product){
    $count_prod++;
    $productId = $product->get_id();
    $variations = $product->get_variations();
    if (!empty($variations)) {
        $variationId = $variations[0]->get_id();
        $im = $variations[0]->get_images(); 
        $file = \Modules\Files\Modul\Taker:: take($im[0]);
                $price = $variations[0]->get_price();
                $priceOld = $variations[0]->get_old_price();
                $name  =$variations[0]->get_name();
    }else{
        $variationId = 0;        
        $file = \Modules\Files\Modul\Taker:: take($product->get_main_image());
                $price = $product->get_price();
                $priceOld = $product->get_old_price();
                $name  =$product->get_name_ru();
    }
    //echo $productId. " ". $variationId;

    //var_dump($product);
?>
                    <div class="b030_oplata_tovar">
                        <div class="b030_oplata_tovar_image">
                            <img src="<?php echo $file->get_path(); ?>" alt="">
                        </div>
                            <div class="b030_oplata_tovar_center_wrap">
                                <div class="b030_oplata_tovar_name"><?php echo $name;?></div>
                                <a href="javascript:void(0)" class="b030_delite_tovar" onclick="deleteProduct(<?php echo $productId; ?>, <?php echo $variationId; ?>)">
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
                                        <?php echo $price;?> ₽
                                    </div>
                                    <div class="b030_oplata_tovar_card_old_price">
                                        <?php echo $priceOld;?>  ₽
                                    </div>
                                    <div class="b030_oplata_tovar_card_price">
                                        Итого: <?php echo ($price*$product->get_count_buy_in_card());?>  ₽
                                    </div>
                                </div>
        
                                <div class="b030_oplata_tovar_numb">
                                        <div class="b030_oplata_tovar_numb_by_box_conter b030_tovar_info_box_by_box_conter">
                                            <button class="b030_quantity-btn b030_decrement b030_oplata_tovar_numb_by_box_conter_quantity_btn" 
        onclick="removeProduct(<?php echo $productId; ?>, <?php echo $variationId; ?>)">-</button>
<input type="text" class="b030_quantity-input b030_oplata_tovar_numb_by_box_conter_quantity_input" 
       value="<?php echo $product->get_count_buy_in_card();?>"
       onblur="updateQuantityFromInput(this, <?php echo $productId; ?>, <?php echo $variationId; ?>)">
<button class="b030_quantity-btn b030_increment b030_oplata_tovar_numb_by_box_conter_quantity_btn" 
        onclick="addProduct(<?php echo $productId; ?>, <?php echo $variationId; ?>)">+</button>
                                        </div>
                                </div>
                            </div>        
                        </div>
<?php
};
if($count_prod == 0){
    echo '<div class="b030_no_tovar">
                        <div class="b030_empty_cart_notification">
                            <p>Ваша корзина пуста</p>
                            <a href="/catalog/" class="b030_catalog_button">Перейти в каталог</a>
                        </div>
                    </div>';
}
?>
                    
                    </div>
        </div>
    </div>
</div>
<script>
    // Функция для обновления итоговой цены
function updateTotalPrice() {
    // Получаем цену товаров
    const totalPriceElement = document.getElementById('total_price');
    const totalPrice = parseFloat(totalPriceElement.textContent) || 0;
    
    // Получаем цену доставки
    const deliveryInput = document.querySelector('input[name="pricePost"]');
    const deliveryPrice = parseFloat(deliveryInput.value) || 0;
    
    // Считаем итоговую сумму
    const totalWithDelivery = totalPrice + deliveryPrice;
    
    // Обновляем элемент с итоговой ценой
    const totalPriceEndElement = document.getElementById('total_price_end');
    totalPriceEndElement.textContent = totalWithDelivery.toFixed(2) + '₽';
        const priceDostElement = document.getElementById('price_dost');
    if (priceDostElement) {
        priceDostElement.textContent = deliveryPrice.toFixed(2) + '₽';
    }
}

// Запускаем отслеживание каждые 0.2 секунды
setInterval(updateTotalPrice, 200);

// Также обновляем при изменении значения вручную (на всякий случай)
document.querySelector('input[name="pricePost"]').addEventListener('input', updateTotalPrice);

// Обновляем при загрузке страницы
document.addEventListener('DOMContentLoaded', updateTotalPrice);

function deleteProduct(productId, variationId) {
    const xhr = new XMLHttpRequest();
    
    const url = `/ajax/card/delete/?product_id=${productId}&variation_id=${variationId}`;
    
    xhr.open('GET', url, true);
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            location.reload();
        } else {
            console.error('Ошибка при удалении товара:', xhr.statusText);
        }
    };
    
    xhr.onerror = function() {
        console.error('Ошибка сети при удалении товара');
    };
    xhr.send();
}

function addProduct(productId, variationId) {
    const xhr = new XMLHttpRequest();
    const url = `/ajax/card/add/?product_id=${productId}&variation_id=${variationId}&quantity=1`;
    
    xhr.open('GET', url, true);
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            location.reload();
        } else {
            console.error('Ошибка при добавлении товара:', xhr.statusText);
        }
    };
    
    xhr.onerror = function() {
        console.error('Ошибка сети при добавлении товара');
    };
    xhr.send();
}

function removeProduct(productId, variationId) {
    const xhr = new XMLHttpRequest();
    const url = `/ajax/card/remove/?product_id=${productId}&variation_id=${variationId}`;
    
    xhr.open('GET', url, true);
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            location.reload();
        } else {
            console.error('Ошибка при уменьшении количества товара:', xhr.statusText);
        }
    };
    
    xhr.onerror = function() {
        console.error('Ошибка сети при уменьшении количества товара');
    };
    xhr.send();
}
// Функция для обновления количества из инпута
function updateQuantityFromInput(inputElement, productId, variationId) {
    const quantity = parseInt(inputElement.value);
    
    // Проверяем валидность введенного значения
    if (isNaN(quantity) || quantity < 1) {
        // Если значение некорректное, восстанавливаем предыдущее значение
        inputElement.value = inputElement.defaultValue;
        alert('Введите корректное количество (не менее 1)');
        return;
    }
    
    // Если значение изменилось, отправляем запрос
    if (quantity !== parseInt(inputElement.defaultValue)) {
        update_quantity(productId, variationId, quantity);
    }
}
function update_quantity(productId, variationId,quantity) {
    const xhr = new XMLHttpRequest();
    const url = `/ajax/card/update_quantity/?product_id=${productId}&variation_id=${variationId}&quantity=${quantity}`;
    
    xhr.open('GET', url, true);
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            location.reload();
        } else {
            console.error('Ошибка при уменьшении количества товара:', xhr.statusText);
        }
    };
    
    xhr.onerror = function() {
        console.error('Ошибка сети при уменьшении количества товара');
    };
    xhr.send();
}
</script>