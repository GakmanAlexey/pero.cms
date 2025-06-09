<form action="/admin/site/seo/edit/?id=<?php echo $this->view_data->get_id();?>" method="post">
    <div class="a014_header_block">
        <div class="a014_header_title">Страница #<?php echo $this->view_data->get_id();?></div>
        <button name="save_boot_seo" value="save" class="a014_add_button">
            Сохранить
        </button>
    </div>
    <div id="box_msg">    
<?php
if($this->view_data2 != []){
    if($this->view_data2["status"]){
echo '
        <div class="a014_toast a014_toast_success">
            <span class="a014_toast_icon">✔</span>
            <span class="a014_toast_text">Данные успешно сохранены</span>
        </div>';
    }else{

echo '
        <div class="a014_toast a014_toast_error">
            <span class="a014_toast_icon">✖</span>
            <span class="a014_toast_text">Ошибка сохранения</span>
        </div>';

    }
}
?>
    </div>

    <div class="a014_form_box_in_user">
        <div class="a014_form_box">
            <div class="a014_input_group">
                <div class="a014_input_wrapper">
                    <input class="a014_input_field" type="text" name="title" placeholder="Простой текст" value="<?php echo $this->view_data->get_title();?>">
                    <label class="a014_input_label" for="title">Заголовок</label>
                    <div class="a014_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
               <div class="a014_input_wrapper">
                    <label class="a014_input_label" for="discription">Описание</label>
                    <textarea class="a014_input_textarea" type="text" name="discription" placeholder="Описание" value="" rows="5" cols="33"><?php echo $this->view_data->get_description();?></textarea>
                    <div class="a014_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
            <div class="a014_input_group">
                <div class="a014_input_wrapper">
                    <input class="a014_input_field" type="text" name="Url" placeholder="Простой текст" value="<?php echo $this->view_data->get_url();?>">
                    <label class="a014_input_label" for="Url">Адрес</label>
                    <div class="a014_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
                <div class="a014_input_wrapper">
                    <input class="a014_input_field" type="text" name="key" placeholder="Простой текст" value="<?php echo $this->view_data->get_keys();?>">
                    <label class="a014_input_label" for="key">Ключ</label>
                    <div class="a014_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
             <div class="a014_input_group">
                <div class="a014_input_wrapper">
                    <input class="a014_input_field" type="text" name="name" placeholder="Простой текст" value="<?php echo $this->view_data->get_name();?>">
                    <label class="a014_input_label" for="name">Имя</label>
                    <div class="a014_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.a014_toast').delay(3000).fadeOut(500, function() {
        $(this).remove();
    });
});
</script>