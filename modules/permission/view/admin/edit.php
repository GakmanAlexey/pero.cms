<form action="/admin/system/permission/edit/?id=<?php echo $this->data_view["id"]; ?>" method="post">
    <div class="a010_header_block">
        <div class="a010_header_title">Привилегия #<?php echo $this->data_view["id"]; ?></div>
        <button name="save_boot_pex" value="save" class="a010_add_button">
            Сохранить
        </button>
    </div>
    <div id="box_msg">    
 <?php
    if($this->data_view2 != []){
             if($this->data_view2['success']){
echo '  
<div class="a010_toast a010_toast_success">
            <span class="a010_toast_icon">✔</span>
            <span class="a010_toast_text">Данные успешно сохранены</span>
        </div>';
    }else{
echo '
        <div class="a010_toast a010_toast_error">
            <span class="a010_toast_icon">✖</span>
            <span class="a010_toast_text"'.$this->data_view2['msg'].'</span>
        </div>';

    }
};?>  
    </div>

    <div class="a010_form_box_in_user">
        <div class="a010_form_box">
            <div class="a010_input_group">
                <div class="a010_input_wrapper">
                    <input class="a010_input_field" type="text" name="code" placeholder="Простой текст" value="<?php echo $this->data_view["code"]; ?>">
                    <label class="a010_input_label" for="code">Код</label>
                    <div class="a010_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
               <div class="a010_input_wrapper">
                    <label class="a010_input_label" for="discription">Описание</label>
                    <textarea class="a010_input_textarea" type="text" name="discription" placeholder="Описание" rows="5" cols="33"><?php echo $this->data_view["description"]; ?></textarea>
                    <div class="a010_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.a010_toast').delay(3000).fadeOut(500, function() {
        $(this).remove();
    });
});
</script>