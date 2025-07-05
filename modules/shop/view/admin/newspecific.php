<form action="" method="post">
    <div class="a030_header_block">
        <div class="a030_header_title">Бренд #1</div>
        <button name="save_boot_new_spec" value="save" class="a030_add_button">
            Сохранить
        </button>
    </div>
    <div id="box_msg">
        <?php
        if($this->data_view["result_add"] ["job"]){
            if($this->data_view["result_add"] ["result"]){
                echo '<div class="a030_toast a030_toast_success">
            <span class="a030_toast_icon">✔</span>
            <span class="a030_toast_text">Данные успешно сохранены! id: '.$this->data_view["result_add"] ["id"].'</span>
        </div>';
            }else{
                echo '
        <div class="a030_toast a030_toast_error">
            <span class="a030_toast_icon">✖</span>
            <span class="a030_toast_text">'.$this->data_view["result_add"] ["msg"].'</span>
        </div>';
            }
        }?>
    </div>

    <div class="a030_form_box_in_user">
        <div class="a030_form_box">
            <div class="a030_input_group">                
                <div class="a030_input_wrapper">
                    <input class="a030_input_field" type="text" name="name" placeholder="Простой текст" value="">
                    <label class="a030_input_label" for="name">Название</label>
                    <div class="a030_error_text hd">Пожалуйста, заполните это поле</div>
                </div>

                <div class="a030_input_wrapper">
                    <input class="a030_input_field" type="text" name="unit" placeholder="Простой текст" value="">
                    <label class="a030_input_label" for="unit">Еденица измерения</label>
                    <div class="a030_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
            </div>
            <div class="a030_input_group">
                <div class="a030_checkbox_wrapper">
                    <label class="a030_checkbox_label">
                        <input type="checkbox" class="a030_checkbox_field" name="card">
                        Отображение в карточке
                    </label>
                </div>

                <div class="a030_checkbox_wrapper">
                    <label class="a030_checkbox_label">
                        <input type="checkbox" class="a030_checkbox_field" name="filter">
                        Отображение в фильтре
                    </label>
                </div>
            </div>
        </div>
    </div>
</form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.a020_toast').delay(3000).fadeOut(500, function() {
        $(this).remove();
    });
});
</script>
