<?php
//var_dump(\Modules\Core\Modul\Menu::get_element("nav"));

foreach(\Modules\Core\Modul\Menu::get_element("nav") as $element){
    echo "<a href='$element[2]' class='$element[0]'>$element[1]</a><br>";
}
            ?>