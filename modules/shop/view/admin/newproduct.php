<form action="" method="post">
    <div class="a023_header_block">
        <div class="a023_header_title">Товар #1</div>
        <button name="save_boot" value="save" class="a023_add_button">
            Сохранить
        </button>
    </div>
    <div id="box_msg">    
        <!-- Успешно -->
        <div class="a023_toast a023_toast_success">
            <span class="a023_toast_icon">✔</span>
            <span class="a023_toast_text">Данные успешно сохранены</span>
        </div>

        <!-- Ошибка -->
        <div class="a023_toast a023_toast_error">
            <span class="a023_toast_icon">✖</span>
            <span class="a023_toast_text">Ошибка сохранения</span>
        </div>
    </div>

    <div class="a023_form_box_in_user">
        <div class="a023_form_box">
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
                <div class="a023_checkbox_wrapper">
                    <label class="a023_checkbox_label">
                        <input type="checkbox" class="a023_checkbox_field" name="agree">
                        Активный
                    </label>
                </div>
                 <div class="a023_input_wrapper">
                    <input class="a023_input_field" type="text" name="nomber_photo" placeholder="Простой текст" value="">
                    <label class="a023_input_label" for="nomber_photo">Номер изображения</label>
                    <div class="a023_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
        </div>
    </div>
</form>