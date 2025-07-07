<form action="" method="post">
    <div class="a026_header_block">
        <div class="a026_header_title">Товар #1</div>
        <button name="save_boot_new_variation" value="save" class="a026_add_button">
            Сохранить
        </button>
    </div>
    <?php
//var_dump($this->data_view["result_add"]);
    ?>
    <div id="box_msg"> 
<?php
if($this->data_view["result_add"]["job"]){
    if($this->data_view["result_add"]["result"]){
        echo '
        <div class="a026_toast a026_toast_success">
            <span class="a026_toast_icon">✔</span>
            <span class="a026_toast_text">Данные успешно сохранены id: '.$this->data_view["result_add"]["id"].'</span>
        </div>';
    }else{
    echo '
        <div class="a026_toast a026_toast_error">
            <span class="a026_toast_icon">✖</span>
            <span class="a026_toast_text">'.$this->data_view["result_add"]["msg"].'</span>
        </div>';
    } 
}  
    ?>
        <!-- Успешно -->

        <!-- Ошибка -->
    </div>

    <div class="a026_form_box_in_user">
        <div class="a026_form_box">
            <div class="a026_input_group">
                <div class="a026_input_wrapper">
                    <input class="a026_input_field" type="text" name="name" placeholder="Простой текст" value="">
                    <label class="a026_input_label" for="name">Название</label>
                    <div class="a026_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
                <div class="a026_input_wrapper">
                    <input class="a026_input_field" type="text" name="art" placeholder="Простой текст" value="">
                    <label class="a026_input_label" for="art">Артикул</label>
                    <div class="a026_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
            <div class="a026_input_group">
                <div class="a026_input_wrapper">
                    <input class="a026_input_field" type="text" name="price" placeholder="Простой текст" value="">
                    <label class="a026_input_label" for="price">Цена</label>
                    <div class="a026_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
                <div class="a026_input_wrapper">
                    <input class="a026_input_field" type="text" name="old_price" placeholder="Простой текст" value="">
                    <label class="a026_input_label" for="old_price">Старая цена</label>
                    <div class="a026_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
            <div class="a026_input_group">
                <div class="a026_checkbox_wrapper">
                    <label class="a026_checkbox_label">
                        <input type="checkbox" class="a026_checkbox_field" name="agree">
                        Активный
                    </label>
                </div>
                 <div class="a026_input_wrapper">
                    <input class="a026_input_field" type="text" name="nomber_photo" placeholder="Простой текст" value="">
                    <label class="a026_input_label" for="nomber_photo">Номер изображения</label>
                    <div class="a026_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
        </div>
    </div>
</form>