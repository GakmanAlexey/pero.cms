<div class="win flex1">
    <div class="container">
        <div class="b030_title_block">
            Оформление заказа
        </div>
    </div>
    <?php

            $cm = new \Modules\Card\Modul\Cardmeneger;
            $cm::load();
            $card = $cm::$card;

            $cardLoadData = new \Modules\Card\Modul\Cardloaddata;
            $crad = $cardLoadData->load($card);
            //var_dump($card->get_product_list());
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
                                        <input class="radio" type="radio" id="huey" name="drone1" value="huey"  />
                                </label>  

                                <label class="b030_radio_parent" style="background-image: url(/modules/card/src/img/porf.svg);" for="hue1y" onclick="widjet.open()">
                                        <input class="radio" type="radio" id="hue1y" name="drone1" value="huey"  />
                                </label> 
                                 
                            </div>
                            <div class=""><br>
                                <div class="b005_input_wrapper">
                                    <input class="b005_input" type="text" placeholder="Код ПВЗ" name="pvz">
                                    <div class="b005_error_message"></div>
                                </div>
                                <div class="b005_input_wrapper">
                                    <input class="b005_input" type="text" placeholder="E-Адрес ПВЗ" name="address">
                                    <div class="b005_error_message"></div>
                                </div>
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
                            <div class="b030_all_price_row_element b030_itog_pay">
                                К оплате
                            </div>
                            
                            <div class="b030_line">
                                
                            </div>
                            <div class="b030_all_price_row_element b030_itog_pay">
                                <?php echo $card->get_price();?>₽
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
    }else{
        $variationId = 0;        
        $file = \Modules\Files\Modul\Taker:: take($product->get_main_image());
    }
    //echo $productId. " ". $variationId;

    //var_dump($product);
?>
                    <div class="b030_oplata_tovar">
                        <div class="b030_oplata_tovar_image">
                            <img src="<?php echo $file->get_path(); ?>" alt="">
                        </div>
                            <div class="b030_oplata_tovar_center_wrap">
                                <div class="b030_oplata_tovar_name"><?php echo $product->get_name_ru();?></div>
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
                                        <?php echo $product->get_price();?> ₽
                                    </div>
                                    <div class="b030_oplata_tovar_card_old_price">
                                        <?php echo $product->get_old_price();?>  ₽
                                    </div>
                                    <div class="b030_oplata_tovar_card_price">
                                        Итого: <?php echo ($product->get_price()*$product->get_count_buy_in_card());?>  ₽
                                    </div>
                                </div>
        
                                <div class="b030_oplata_tovar_numb">
                                        <div class="b030_oplata_tovar_numb_by_box_conter b030_tovar_info_box_by_box_conter">
                                            <button class="b030_quantity-btn b030_decrement b030_oplata_tovar_numb_by_box_conter_quantity_btn">-</button>
                                            <input type="text" class="b030_quantity-input b030_oplata_tovar_numb_by_box_conter_quantity_input" value="<?php echo $product->get_count_buy_in_card();?>">
                                            <button class="b030_quantity-btn b030_increment b030_oplata_tovar_numb_by_box_conter_quantity_btn">+</button>
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