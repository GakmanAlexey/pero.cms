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
                    <a class="b002_nav_item" href="">Каталог</a>
                    <a class="b002_nav_item" href="">Доставка и оплата</a>
                    <a class="b002_nav_item" href="">О нас</a>
                    <a class="b002_nav_item" href="">Контакты</a>
                </div>

                <div class="b002_nav_btn">
                    Кпопка призыва
                </div>
            </div>
        </div>
    </div>