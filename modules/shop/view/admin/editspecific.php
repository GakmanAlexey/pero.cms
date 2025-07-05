<form action="" method="post">
    <div class="a029_header_block">
        <div class="a029_header_title">Бренд #1</div>
        <button name="save_boot" value="save" class="a029_add_button">
            Сохранить
        </button>
    </div>
    <div id="box_msg">    
        <!-- Успешно -->
        <div class="a029_toast a029_toast_success">
            <span class="a029_toast_icon">✔</span>
            <span class="a029_toast_text">Данные успешно сохранены</span>
        </div>

        <!-- Ошибка -->
        <div class="a029_toast a029_toast_error">
            <span class="a029_toast_icon">✖</span>
            <span class="a029_toast_text">Ошибка сохранения</span>
        </div>
    </div>

    <div class="a029_form_box_in_user">
        <div class="a029_form_box">
            <div class="a029_input_group">                
                <div class="a029_input_wrapper">
                    <input class="a029_input_field" type="text" name="name" placeholder="Простой текст" value="">
                    <label class="a029_input_label" for="name">Название</label>
                    <div class="a029_error_text hd">Пожалуйста, заполните это поле</div>
                </div>

                <div class="a029_input_wrapper">
                    <select class="a029_input_field_select" name="unit">
                        <option value="" disabled selected>Выберите еденицу измерения</option>
                        <option value="option1">Опция 1</option>
                        <option value="option2">Опция 2</option>
                    </select>
                    <label class="a029_input_label" for="unit">Еденица измерения</label>
                    <div class="a029_error_text hd">Пожалуйста, выберите значение</div>
                </div>
            </div>
            </div>
            <div class="a029_input_group">
                <div class="a029_checkbox_wrapper">
                    <label class="a029_checkbox_label">
                        <input type="checkbox" class="a029_checkbox_field" name="card">
                        Отображение в карточке
                    </label>
                </div>

                <div class="a029_checkbox_wrapper">
                    <label class="a029_checkbox_label">
                        <input type="checkbox" class="a029_checkbox_field" name="filter">
                        Отображение в фильтре
                    </label>
                </div>
            </div>
        </div>
    </div>
</form>
