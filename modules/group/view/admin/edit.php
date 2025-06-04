<form action="" method="post">
    <div class="a008_header_block">
        <div class="a008_header_title">Группа #1</div>
        <button name="save_boot" value="save" class="a008_add_button">
            Сохранить
        </button>
    </div>
    <div id="box_msg">    
        <!-- Успешно -->
        <div class="a008_toast a008_toast_success">
            <span class="a008_toast_icon">✔</span>
            <span class="a008_toast_text">Данные успешно сохранены</span>
        </div>

        <!-- Ошибка -->
        <div class="a008_toast a008_toast_error">
            <span class="a008_toast_icon">✖</span>
            <span class="a008_toast_text">Ошибка сохранения</span>
        </div>
    </div>

    <div class="a008_form_box_in_user">
        <div class="a008_form_box">
            <div class="a008_input_group">
                <div class="a008_input_wrapper">
                    <input class="a008_input_field" type="text" name="username" placeholder="Простой текст" value="">
                    <label class="a008_input_label" for="username">Имя на Русском</label>
                    <div class="a008_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
                <div class="a008_input_wrapper">
                    <input class="a008_input_field" type="text" name="mail" placeholder="name@exemple.ru" value="">
                    <label class="a008_input_label" for="mail">Системное имя</label>
                    <div class="a008_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
            <div class="a008_input_group">
                <div class="a008_input_wrapper">
                    <input class="a008_input_field" type="text" name="username" placeholder="Простой текст" value="">
                    <label class="a008_input_label" for="username">Префикс</label>
                    <div class="a008_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
                <div class="a008_input_wrapper">
                    <label class="a008_input_label" for="discription">Описание</label>
                    <textarea class="a008_input_textarea" type="text" name="discription" placeholder="Описание" value="" rows="5" cols="33"></textarea>
                    <div class="a008_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
        </div>
    </div>
</form>