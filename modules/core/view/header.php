<?php
//var_dump(\Modules\Core\Modul\Menu::get_element("nav"));

foreach(\Modules\Core\Modul\Menu::get_element("nav") as $element){
   // echo "<a href='$element[2]' class='$element[0]'>$element[1]</a><br>";
}
            ?>

    <div class="b002_nav">
        <div class="container">
            <div class="b002_nav_box">
                <div class="b002_nav_logo_box">
                    <img src="src/img/logo.svg" alt="">
                </div>
                <div class="b002_nav_navigatin">
                    <a class="b002_nav_item" href="/catalog/">Каталог</a>
                    <a class="b002_nav_item" href="">Доставка и оплата</a>
                    <a class="b002_nav_item" href="">О нас</a>
                    <a class="b002_nav_item" href="">Контакты</a>
                    <form>
                    <div class="search_box hd_mob">
                      <input
                        class="search_input"
                        type="search"
                        id="mySearch"
                        name="q"
                        placeholder="Search the site…" />
                        <button class="search_btn"> 
                            <svg width="20" height="22" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.5 21.4667C16.7467 21.4667 21 17.1188 21 11.7555C21 6.39225 16.7467 2.04443 11.5 2.04443C6.25329 2.04443 2 6.39225 2 11.7555C2 17.1188 6.25329 21.4667 11.5 21.4667Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M22 22.4889L20 20.4445" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>       
                        </button>
                    </div>
                  </form>

                    <a href="/card/" class="cart_icon nav_btn_box_link">
                        <svg class="nav_btn_box_svg" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.66675 2.66669H4.98676C6.42676 2.66669 7.56008 3.90669 7.44008 5.33335L6.33341 18.6133C6.14675 20.7867 7.86674 22.6533 10.0534 22.6533H24.2534C26.1734 22.6533 27.8534 21.08 28.0001 19.1734L28.7201 9.17336C28.8801 6.96003 27.2001 5.16001 24.9734 5.16001H7.76009" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M21.6667 29.3333C22.5871 29.3333 23.3333 28.5871 23.3333 27.6667C23.3333 26.7462 22.5871 26 21.6667 26C20.7462 26 20 26.7462 20 27.6667C20 28.5871 20.7462 29.3333 21.6667 29.3333Z" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10.9999 29.3333C11.9204 29.3333 12.6666 28.5871 12.6666 27.6667C12.6666 26.7462 11.9204 26 10.9999 26C10.0794 26 9.33325 26.7462 9.33325 27.6667C9.33325 28.5871 10.0794 29.3333 10.9999 29.3333Z" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 10.6667H28" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <div class="nomber_cart">
                            <?php                                
                            $cardAjax =  new \Modules\Card\Modul\Cardajax;
                            echo $cardAjax->viewCountProduct();
                            ?>
                        </div>
                    </a>
                </div>

                <div class="b002_nav_btn">
                    Кпопка призыва
                </div>
            </div>
        </div>
    </div>