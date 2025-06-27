<form action="" method="post">
    <div class="a016_header_block">
        <div class="a016_header_title">Создание бренда</div>
        <button name="save_boot_new_brand" value="save" class="a016_add_button">
            Сохранить
        </button>
    </div>
<?php
if($this->data_view['job']){
    if($this->data_view['status']){
        echo '<div id="box_msg">    
        <!-- Успешно -->
        <div class="a016_toast a016_toast_success">
            <span class="a016_toast_icon">✔</span>
            <span class="a016_toast_text">Данные успешно сохранены '.$this->data_view['id'].'</span>
        </div>
    </div>';
    }else{
        echo '<div id="box_msg"> 

        <!-- Ошибка -->
        <div class="a016_toast a016_toast_error">
            <span class="a016_toast_icon">✖</span>
            <span class="a016_toast_text">'.$this->data_view['msg'].'</span>
        </div>
    </div>';
    }
   
}
?>
    

    <div class="a016_form_box_in_user">
        <div class="a016_form_box">
            <div class="a016_input_group">
                <div class="a016_input_wrapper">
                    <input class="a016_input_field" type="text" name="name" placeholder="Простой текст" value="">
                    <label class="a016_input_label" for="name">Название</label>
                    <div class="a016_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
                <div class="a016_input_wrapper">
                    <input class="a016_input_field" type="text" name="nomber_photo" placeholder="Простой текст" value="">
                    <label class="a016_input_label" for="nomber_photo">Номер изображения</label>
                    <div class="a016_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
            </div>
            <div class="a016_input_group">
                <div class="a016_input_wrapper">
                    <label class="a016_input_label" for="mini_discription">Краткое описание</label>
                    <textarea class="a016_input_textarea" type="text" name="mini_discription" placeholder="Описание" value="" rows="5" cols="33"></textarea>
                    <div class="a016_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
                <div class="a016_input_wrapper">
                    <label class="a016_input_label" for="discription">Описание</label>
                    <textarea class="a016_input_textarea" type="text" name="discription" placeholder="Описание" value="" rows="5" cols="33"></textarea>
                    <div class="a016_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
        </div>
    </div>
</form>