
<form action="/admin/shop/categor/new/" method="post">
    
    <div class="a020_header_block">
        <div class="a020_header_title">Новая категория</div>
        <button name="save_boot_new_cat" value="save" class="a020_add_button">
            Сохранить
        </button>
    </div>
    <div id="box_msg">  
<?php
if($this->data_view["result"]["job"]){
    if($this->data_view["result"]["status"]){
echo '<div class="a020_toast a020_toast_success">
            <span class="a020_toast_icon">✔</span>
            <span class="a020_toast_text">'.$this->data_view["result"]["msg"].' id:'.$this->data_view["result"]["id"].'</span>
        </div>';
    }else{
echo '<div class="a020_toast a020_toast_error">
            <span class="a020_toast_icon">✖</span>
            <span class="a020_toast_text">'.$this->data_view["result"]["msg"].'</span>
        </div>';
    }
}
?>
    </div>

    <div class="a020_form_box_in_user">
        <div class="a020_form_box">
            <div class="a020_input_group">
                <div class="a020_input_wrapper">
                    <select class="a020_input_field_select" name="category">
                        <?php
foreach($this->data_view["categor"] as $item_categor){
    echo    '<option value="'.$item_categor->get_id().'">'.$item_categor->get_name_ru().'</option>';
}
                        ?>
                    </select>
                    <label class="a020_input_label" for="category">Категория</label>
                    <div class="a020_error_text hd">Пожалуйста, выберите значение</div>
                </div>
                <div class="a020_input_wrapper">
                    <input class="a020_input_field" type="text" name="nomber_photo" placeholder="Простой текст" value="">
                    <label class="a020_input_label" for="nomber_photo">Номер изображения</label>
                    <div class="a020_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
        </div>
            <div class="a020_input_group">
                <div class="a020_input_wrapper">
                    <input class="a020_input_field" type="text" name="name" placeholder="Простой текст" value="">
                    <label class="a020_input_label" for="name">Наименование</label>
                </div>
                <div class="a020_input_wrapper">
                    <label class="a020_input_label" for="text">Текст</label>
                    <textarea class="a020_input_textarea" type="text" name="text" placeholder="Описание" value="" rows="5" cols="33"></textarea>
                    <div class="a020_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
            <div class="a020_input_group">
                <div class="a020_checkbox_wrapper">
                    <label class="a020_checkbox_label">
                        <input type="checkbox" class="a020_checkbox_field" name="agree">
                        Отображение
                    </label>
                </div>
                <div class="a020_input_wrapper">
                    <label class="a020_input_label" for="discription">Описание</label>
                    <textarea class="a020_input_textarea" type="text" name="discription" placeholder="Описание" value="" rows="5" cols="33"></textarea>
                    <div class="a020_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
        </div>
    </div>
</form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.a020_toast').delay(3000).fadeOut(500, function() {
        $(this).remove();
    });
});
</script>



