<form action="" method="post">
    <div class="a024_header_block">
        <div class="a024_header_title">Товар #1</div>
        <button name="save_boot" value="save" class="a024_add_button">
            Сохранить
        </button>
    </div>
    <div id="box_msg">    
        <!-- Успешно -->
        <div class="a024_toast a024_toast_success">
            <span class="a024_toast_icon">✔</span>
            <span class="a024_toast_text">Данные успешно сохранены</span>
        </div>

        <!-- Ошибка -->
        <div class="a024_toast a024_toast_error">
            <span class="a024_toast_icon">✖</span>
            <span class="a024_toast_text">Ошибка сохранения</span>
        </div>
    </div>

    <div class="a024_form_box_in_user">
        <div class="a024_form_box">
             <div class="a024_input_group">
                <div class="a024_input_wrapper">
                    <select class="a024_input_field_select" name="category">
                        <option value="" disabled selected>Выберите категорию</option>
                        <option class="a024_green" value="option1">Опция 1</option>
                        <option class="a024_grey" value="option2">Опция 2</option>
                    </select>
                    <label class="a024_input_label" for="category">Категория</label>
                    <div class="a024_error_text hd">Пожалуйста, выберите значение</div>
                </div>
            </div>
             <div class="a024_input_group">
                <div class="a024_input_wrapper">
                    <input class="a024_input_field" type="text" name="name" placeholder="Простой текст" value="">
                    <label class="a024_input_label" for="name">Название</label>
                    <div class="a024_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
                <div class="a024_input_wrapper">
                    <input class="a024_input_field" type="text" name="art" placeholder="Простой текст" value="">
                    <label class="a024_input_label" for="art">Артикул</label>
                    <div class="a024_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
            <div class="a024_input_group">
                <div class="a024_input_wrapper">
                    <input class="a024_input_field" type="text" name="price" placeholder="Простой текст" value="">
                    <label class="a024_input_label" for="price">Цена</label>
                    <div class="a024_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
                <div class="a024_input_wrapper">
                    <input class="a024_input_field" type="text" name="old_price" placeholder="Простой текст" value="">
                    <label class="a024_input_label" for="old_price">Старая цена</label>
                    <div class="a024_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
            <div class="a024_input_group">
                <div class="a024_checkbox_wrapper">
                    <label class="a024_checkbox_label">
                        <input type="checkbox" class="a024_checkbox_field" name="agree">
                        Активный
                    </label>
                </div>
                 <div class="a024_input_wrapper">
                    <input class="a024_input_field" type="text" name="nomber_photo" placeholder="Простой текст" value="">
                    <label class="a024_input_label" for="nomber_photo">Номер изображения</label>
                    <div class="a024_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
        </div>
    </div>
</form>


