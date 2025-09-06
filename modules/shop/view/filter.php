<?php
    $fil = new \Modules\Shop\Modul\Filtermenedger;
    $fil->init_job_array($this->data_view["product_list"]->get_list_product());
    $unique_specs = $fil->filter->get_unique_specifications();
    $spec_values = $fil->filter->get_specification_values();
    $min_price =  (int)$fil->filter->get_price_min();
    $max_price =  (int)$fil->filter->get_price_max();

?><div class="katalog_box">
    <a class="b026_mobile_filter" href="">

        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M22.0156 6.5H16.0156" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6.01562 6.5H2.01562" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M10.0156 10C11.9486 10 13.5156 8.433 13.5156 6.5C13.5156 4.567 11.9486 3 10.0156 3C8.08263 3 6.51562 4.567 6.51562 6.5C6.51562 8.433 8.08263 10 10.0156 10Z" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M22.0156 17.5H18.0156" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M8.01562 17.5H2.01562" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M14.0156 21C15.9486 21 17.5156 19.433 17.5156 17.5C17.5156 15.567 15.9486 14 14.0156 14C12.0826 14 10.5156 15.567 10.5156 17.5C10.5156 19.433 12.0826 21 14.0156 21Z" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>                            

    </a>
    <form method="get" class="b026_filter_left">
        <div class="b026_filter_box">
            <a class="b026_closed_filter" href="">
                <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 17L16 1" stroke="#171717" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 17L1 1" stroke="#171717" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>                                
            </a>
            <div class="b026_filter_title">
                Цена, ₽
            </div>                        
            <div class="b026_range_container">
                <div class="b026_range_inputs">
                    <input type="number" id="min_input" value="<?php echo $min_price;?>" min="<?php echo $min_price;?>" max="<?php echo $max_price;?>" />
                    <div class="b026_filter_tire"></div>
                    <input type="number" id="max_input" value="<?php echo $max_price;?>" min="<?php echo $min_price;?>" max="<?php echo $max_price;?>" />
                </div>
                <div class="b026_range_bar_container">
                    <div class="b026_range_fill" id="range_fill"></div>
                    <div class="b026_range_thumb" id="min_thumb"></div>
                    <div class="b026_range_thumb" id="max_thumb"></div>
                </div>
            </div>
        </div>
        <div class="b026_filter_box">
            <div class="b026_filter_title">
                Производитель
            </div>                        
            <div class="b026_checkbox_box">
                <div class="b026_padio_elem">
                    <input type="checkbox" id="selectAll" onclick="document.querySelectorAll('.b026_chek_e').forEach(checkbox => checkbox.checked = this.checked)">
                    <label for="selectAll">Выбрать все</label>
                </div>
                <?php
foreach($fil->filter->get_brand() as $i_brand){
    echo '      <div class="b026_padio_elem">
                    <input type="checkbox" class="b026_custom-checkbox b026_chek_e" id="'.$i_brand->get_name().'" name="'.$i_brand->get_name().'" value="'.$i_brand->get_id().'">
                    <label for="'.$i_brand->get_name().'">'.$i_brand->get_name_ru().'</label>
                </div>';
}
                ?>
                
                
            </div>                        
        </div>

        <div class="b026_filter_box">
            <div class="b026_filter_title">
                Наличие
            </div>                        
            <div class="b026_radio_box">
                <div class="b026_padio_elem">
                    <input type="radio" id="option1" name="options" value="1" checked>
                    <label for="option1">Все</label>
                </div>
                <div class="b026_padio_elem">
                    <input type="radio" id="option2" name="options" value="2">
                    <label for="option2">В наличии</label>
                </div>                            
                <div class="b026_padio_elem">
                    <input type="radio" id="option3" name="options" value="3">
                    <label for="option3">Нет в наличии</label>
                </div> 
            </div>                        
        </div>
        <div class="b026_filter_box">
<?php
$pam1 = 0;
foreach($unique_specs as $item_name => $item_param){
    $pam1++;
    echo '<div class="b026_filter_title">
               '.$item_param["name"].'
            </div>                        
            <div class="b026_checkbox_box">
                <div class="b026_padio_elem">
                    <input type="checkbox" id="selectAll2" onclick="document.querySelectorAll(\'.class_tov_'.$pam1.'\').forEach(checkbox => checkbox.checked = this.checked)">
                    <label for="selectAll2">Выбрать все</label>
                </div>';
                $pam2 =0;
                foreach($spec_values[$item_param["key"]] as $spec_values_item){
                    $pam2++;
                    echo '
                    <div class="b026_padio_elem">
                        <input type="checkbox" class="b026_custom-checkbox b026_chek_e2 class_tov_'.$pam1.'" id="22" name="'.$item_param["key"].'" value="'.$pam2.'">
                        <label for="22">'.$spec_values_item.' '.$item_param["unit"].'</label>
                    </div> ';
                }                       
           echo '</div>   ';
}
?>
            
<?php
?>                     
        </div>

        <button class="b026_btn_form b026_filtre_btn">Поиск по фильтрам</button>
        <a class="b026_link_filter" href="">Сбросить все фильтры</a>
    </form>
