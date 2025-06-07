<form action="" method="post">
    <div class="a014_header_block">
        <div class="a014_header_title">Страница #1</div>
        <button name="save_boot" value="save" class="a014_add_button">
            Сохранить
        </button>
    </div>
    <div id="box_msg">    
        <!-- Успешно -->
        <div class="a014_toast a014_toast_success">
            <span class="a014_toast_icon">✔</span>
            <span class="a014_toast_text">Данные успешно сохранены</span>
        </div>

        <!-- Ошибка -->
        <div class="a014_toast a014_toast_error">
            <span class="a014_toast_icon">✖</span>
            <span class="a014_toast_text">Ошибка сохранения</span>
        </div>
    </div>

    <div class="a014_form_box_in_user">
        <div class="a014_form_box">
            <div class="a014_input_group">
                <div class="a014_input_wrapper">
                    <input class="a014_input_field" type="text" name="title" placeholder="Простой текст" value="">
                    <label class="a014_input_label" for="title">Заголовок</label>
                    <div class="a014_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
               <div class="a014_input_wrapper">
                    <label class="a014_input_label" for="discription">Описание</label>
                    <textarea class="a014_input_textarea" type="text" name="discription" placeholder="Описание" value="" rows="5" cols="33"></textarea>
                    <div class="a014_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
            <div class="a014_input_group">
                <div class="a014_input_wrapper">
                    <input class="a014_input_field" type="text" name="Url" placeholder="Простой текст" value="">
                    <label class="a014_input_label" for="Url">Адрес</label>
                    <div class="a014_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
                <div class="a014_input_wrapper">
                    <input class="a014_input_field" type="text" name="key" placeholder="Простой текст" value="">
                    <label class="a014_input_label" for="key">Ключ</label>
                    <div class="a014_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
             <div class="a014_input_group">
                <div class="a014_input_wrapper">
                    <input class="a014_input_field" type="text" name="name" placeholder="Простой текст" value="">
                    <label class="a014_input_label" for="name">Имя</label>
                    <div class="a014_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
        </div>
    </div>
</form>