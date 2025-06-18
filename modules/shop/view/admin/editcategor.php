<form action="" method="post">
    <div class="a019_header_block">
        <div class="a019_header_title">Бренд #1</div>
        <button name="save_boot" value="save" class="a019_add_button">
            Сохранить
        </button>
    </div>
    <div id="box_msg">    
        <!-- Успешно -->
        <div class="a019_toast a019_toast_success">
            <span class="a019_toast_icon">✔</span>
            <span class="a019_toast_text">Данные успешно сохранены</span>
        </div>

        <!-- Ошибка -->
        <div class="a019_toast a019_toast_error">
            <span class="a019_toast_icon">✖</span>
            <span class="a019_toast_text">Ошибка сохранения</span>
        </div>
    </div>

    <div class="a019_form_box_in_user">
        <div class="a019_form_box">
            <div class="a019_input_group">
                <div class="a019_input_wrapper">
                    <select class="a019_input_field_select" name="category">
                        <option value="" disabled selected>Выберите категорию</option>
                        <option value="option1">Опция 1</option>
                        <option value="option2">Опция 2</option>
                    </select>
                    <label class="a019_input_label" for="category">Категория</label>
                    <div class="a019_error_text hd">Пожалуйста, выберите значение</div>
                </div>
                <div class="a019_input_wrapper">
                    <input class="a019_input_field" type="text" name="nomber_photo" placeholder="Простой текст" value="">
                    <label class="a019_input_label" for="nomber_photo">Номер изображения</label>
                    <div class="a019_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
            </div>
            <div class="a019_input_group">
                <div class="a019_checkbox_wrapper">
                    <label class="a019_checkbox_label">
                        <input type="checkbox" class="a019_checkbox_field" name="agree">
                        Отображение
                    </label>
                </div>
                <div class="a019_input_wrapper">
                    <label class="a019_input_label" for="discription">Описание</label>
                    <textarea class="a019_input_textarea" type="text" name="discription" placeholder="Описание" value="" rows="5" cols="33"></textarea>
                    <div class="a019_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
        </div>
    </div>
</form>