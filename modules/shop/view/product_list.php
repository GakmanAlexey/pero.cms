    <div class="b024_product_katalog">
        
<?php    

//var_dump($this->data_view["product_list"]);
foreach($this->data_view["product_list"]->get_list_product() as $product){

    //var_dump($product);
        $file = \Modules\Files\Modul\Taker:: take($product->get_main_image());
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
            <a href="#1" class="b024_product_item_old_price_cart">
                <svg width="25" height="25" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="b024_product_item_old_price_cart_icon" d="M2.66675 2.66669H4.98676C6.42676 2.66669 7.56008 3.90669 7.44008 5.33335L6.33341 18.6133C6.14675 20.7867 7.86674 22.6533 10.0534 22.6533H24.2534C26.1734 22.6533 27.8534 21.08 28.0001 19.1734L28.7201 9.17336C28.8801 6.96003 27.2001 5.16001 24.9734 5.16001H7.76009" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path class="b024_product_item_old_price_cart_icon" d="M21.6667 29.3333C22.5871 29.3333 23.3333 28.5871 23.3333 27.6667C23.3333 26.7462 22.5871 26 21.6667 26C20.7462 26 20 26.7462 20 27.6667C20 28.5871 20.7462 29.3333 21.6667 29.3333Z" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path class="b024_product_item_old_price_cart_icon" d="M10.9999 29.3333C11.9204 29.3333 12.6666 28.5871 12.6666 27.6667C12.6666 26.7462 11.9204 26 10.9999 26C10.0794 26 9.33325 26.7462 9.33325 27.6667C9.33325 28.5871 10.0794 29.3333 10.9999 29.3333Z" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path class="b024_product_item_old_price_cart_icon" d="M12 10.6667H28" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>                                    
            </a>
            </div>
        </div>';
        //var_dump($product->get_specific());

        if($product->get_variations() != []){
            foreach($product->get_variations() as $variant){
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
                    <a href="#1" class="b024_product_item_old_price_cart">
                        <svg width="25" height="25" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="b024_product_item_old_price_cart_icon" d="M2.66675 2.66669H4.98676C6.42676 2.66669 7.56008 3.90669 7.44008 5.33335L6.33341 18.6133C6.14675 20.7867 7.86674 22.6533 10.0534 22.6533H24.2534C26.1734 22.6533 27.8534 21.08 28.0001 19.1734L28.7201 9.17336C28.8801 6.96003 27.2001 5.16001 24.9734 5.16001H7.76009" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path class="b024_product_item_old_price_cart_icon" d="M21.6667 29.3333C22.5871 29.3333 23.3333 28.5871 23.3333 27.6667C23.3333 26.7462 22.5871 26 21.6667 26C20.7462 26 20 26.7462 20 27.6667C20 28.5871 20.7462 29.3333 21.6667 29.3333Z" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path class="b024_product_item_old_price_cart_icon" d="M10.9999 29.3333C11.9204 29.3333 12.6666 28.5871 12.6666 27.6667C12.6666 26.7462 11.9204 26 10.9999 26C10.0794 26 9.33325 26.7462 9.33325 27.6667C9.33325 28.5871 10.0794 29.3333 10.9999 29.3333Z" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path class="b024_product_item_old_price_cart_icon" d="M12 10.6667H28" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                                    
                    </a>
                    </div>
                </div>';
            }
        }
}
?>

    </div>
</div>