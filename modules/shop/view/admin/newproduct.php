<form action="/admin/shop/product/new/" method="post">
    <div class="a023_header_block">
        <div class="a023_header_title">Товар #1</div>
        <button name="save_boot_new_product" value="save" class="a023_add_button">
            Сохранить
        </button>
    </div>
    <div id="box_msg">   
<?php
if($this->data_view["result_add"]["job"]){
    if($this->data_view["result_add"]["result"]){
echo '  <div class="a023_toast a023_toast_success">
            <span class="a023_toast_icon">✔</span>
            <span class="a023_toast_text">Данные успешно сохранены id: '.$this->data_view["result_add"]["id"].'</span>
        </div>';
    }else{
        
echo '  <div class="a023_toast a023_toast_error">
            <span class="a023_toast_icon">✖</span>
            <span class="a023_toast_text"'.$this->data_view["result_add"]["msg"].'</span>
        </div>';
    }
}
?> 
    </div>
    <div class="a023_form_box_in_user">
        <div class="a023_form_box">
             <div class="a023_input_group">
                <div class="a023_input_wrapper">
                    <select class="a024_input_field_select" name="category">
<?php
foreach($this->data_view["categor_list"] as $item_cat){
    if($item_cat->get_is_active() == 1){
        $class = "a024_green";
    }else{
        $class = "a024_grey";
    }
    echo '<option class="'.$class.'" value="'.$item_cat->get_id().'">'.$item_cat->get_name_ru().'</option>';
}
?>
                    </select>
                    <label class="a024_input_label" for="category">Категория</label>
                    <div class="a024_error_text hd">Пожалуйста, выберите значение</div>
                </div>
            </div>
            <div class="a023_input_group">
                <div class="a023_input_wrapper">
                    <input class="a023_input_field" type="text" name="name" placeholder="Простой текст" value="">
                    <label class="a023_input_label" for="name">Название</label>
                    <div class="a023_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
                <div class="a023_input_wrapper">
                    <input class="a023_input_field" type="text" name="art" placeholder="Простой текст" value="">
                    <label class="a023_input_label" for="art">Артикул</label>
                    <div class="a023_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
            <div class="a023_input_group">
                <div class="a023_input_wrapper">
                    <input class="a023_input_field" type="text" name="price" placeholder="Простой текст" value="">
                    <label class="a023_input_label" for="price">Цена</label>
                    <div class="a023_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
                <div class="a023_input_wrapper">
                    <input class="a023_input_field" type="text" name="old_price" placeholder="Простой текст" value="">
                    <label class="a023_input_label" for="old_price">Старая цена</label>
                    <div class="a023_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
            <div class="a023_input_group">
                <div class="a023_input_wrapper">
                    <input class="a023_input_field" type="text" name="main_photo" placeholder="Простой текст" value="">
                    <label class="a023_input_label" for="main_photo">Номер основного изображения</label>
                    <div class="a023_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
                <div class="a023_input_wrapper">
                    <input class="a023_input_field" type="text" name="nomber_photo" placeholder="Простой текст" value="">
                    <label class="a023_input_label" for="nomber_photo">Номера дополнительных изображения (через запятую)</label>
                    <div class="a023_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
            <div class="a023_input_group">
                <div class="a023_checkbox_wrapper">
                    <label class="a023_checkbox_label">
                        <input type="checkbox" class="a023_checkbox_field" name="agree">
                        Активный
                    </label>
                </div>
                
            </div>
        </div>
    </div>
</form>