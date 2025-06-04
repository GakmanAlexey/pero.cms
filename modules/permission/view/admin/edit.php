<form action="" method="post">
    <div class="a010_header_block">
        <div class="a010_header_title">Привилегия #1</div>
        <button name="save_boot" value="save" class="a010_add_button">
            Сохранить
        </button>
    </div>
    <div id="box_msg">    
        <!-- Успешно -->
        <div class="a010_toast a010_toast_success">
            <span class="a010_toast_icon">✔</span>
            <span class="a010_toast_text">Данные успешно сохранены</span>
        </div>

        <!-- Ошибка -->
        <div class="a010_toast a010_toast_error">
            <span class="a010_toast_icon">✖</span>
            <span class="a010_toast_text">Ошибка сохранения</span>
        </div>
    </div>

    <div class="a010_form_box_in_user">
        <div class="a010_form_box">
            <div class="a010_input_group">
                <div class="a010_input_wrapper">
                    <input class="a010_input_field" type="text" name="username" placeholder="Простой текст" value="">
                    <label class="a010_input_label" for="username">Код</label>
                    <div class="a010_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
               <div class="a010_input_wrapper">
                    <label class="a010_input_label" for="discription">Описание</label>
                    <textarea class="a010_input_textarea" type="text" name="discription" placeholder="Описание" value="" rows="5" cols="33"></textarea>
                    <div class="a010_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
        </div>
    </div>
</form>