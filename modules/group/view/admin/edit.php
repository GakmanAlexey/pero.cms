<form action="/admin/system/group/edit/?id=<?php echo  $this->data_view->get_id() ;?>" method="post">
    <div class="a008_header_block">
        <div class="a008_header_title">Группа #<?php echo  $this->data_view->get_id() ;?></div>
        <button name="save_boot_gp" value="save" class="a008_add_button">
            Сохранить
        </button>
    </div>
    <div id="box_msg">   
 <?php
    if($this->data_view2 != []){
             if($this->data_view2['success']){
echo '  
        <div class="a008_toast a008_toast_success">
            <span class="a008_toast_icon">✔</span>
            <span class="a008_toast_text">Данные успешно сохранены</span>
        </div>';
    }else{
echo '
        <div class="a008_toast a008_toast_error">
            <span class="a008_toast_icon">✖</span>
            <span class="a008_toast_text">'.$this->data_view2['msg'].'</span>
        </div>';

    }
};?> 
    </div>

    <div class="a008_form_box_in_user">
        <div class="a008_form_box">
            <div class="a008_input_group">
                <div class="a008_input_wrapper">
                    <input class="a008_input_field" type="text" name="name_ru" placeholder="Простой текст" value="<?php echo  $this->data_view->get_name_ru() ;?>">
                    <label class="a008_input_label" for="name_ru">Имя на Русском</label>
                    <div class="a008_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
                <div class="a008_input_wrapper">
                    <input class="a008_input_field" type="text" name="name" placeholder="" value="<?php echo  $this->data_view->get_name() ;?>">
                    <label class="a008_input_label" for="name">Системное имя (не меняйте)</label>
                    <div class="a008_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
            <div class="a008_input_group">
                <div class="a008_input_wrapper">
                    <input class="a008_input_field" type="text" name="prefix" placeholder="Простой текст" value="<?php echo  $this->data_view->get_prefix() ;?>">
                    <label class="a008_input_label" for="prefix">Префикс</label>
                    <div class="a008_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
                <div class="a008_input_wrapper">
                    <label class="a008_input_label" for="discription">Описание</label>
                    <textarea class="a008_input_textarea" type="text" name="discription" placeholder="Описание" rows="5" cols="33"><?php echo  $this->data_view->get_description() ;?></textarea>
                    <div class="a008_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.a008_toast').delay(3000).fadeOut(500, function() {
        $(this).remove();
    });
});
</script>