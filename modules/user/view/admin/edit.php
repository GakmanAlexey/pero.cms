
<form action="/admin/system/user/edit/?id=<?php echo $this->data_view->get_id();?>" method="post">
<div class="a006_header_block">
    <div class="a006_header_title">Пользователь #<?php echo $this->data_view->get_id();?>
    </div>
    <button name="save_boot" value="save" class="a006_add_button">
        Сохранить
    </button>
</div>
<div id="box_msg">
 <?php
    if($this->data_view2 != []){
        echo '
        
                    <div class="a006_toast a006_toast_error">
                        <span class="a006_toast_icon">✖</span>
                        <span class="a006_toast_text">'.$this->data_view2[0].'</span>
                    </div>
                    ';
    }
                     ?>
</div>
<div class="a006_form_box_in_user">
   
   
        <div class="a006_form_box">
            <div class="a006_input_group">
                <div class="a006_input_wrapper">
                    <input class="a006_input_field" type="text" name="username" placeholder="Простой текст" value="<?php echo $this->data_view->get_username();?>">
                    <label class="a006_input_label" for="username">Логин</label>
                    <div class="a006_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
                <div class="a006_input_wrapper">
                    <input class="a006_input_field" type="text" name="mail" placeholder="name@exemple.ru" value="<?php echo $this->data_view->get_email();?>">
                    <label class="a006_input_label" for="mail">Электронная почта</label>
                    <div class="a006_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>
            <div class="a006_input_group">
                <div class="a006_input_wrapper">
                    <input class="a006_input_field" type="text" name="password" placeholder="Простой текст" value="<?php if($this->data_view->get_password_hash() != ""){echo "********";}?>">
                    <label class="a006_input_label" for="password">Пароль</label>
                    <div class="a006_error_text hd">Пожалуйста, заполните это поле</div>
                </div>
            </div>        
        </div>

        <div class="a006_status">
            <div class="a006_status_wrapper">
                <div class="a006_title_in_user">
                    Статус
                </div>
                <div class="a006_status_information_wrapper">
            <?php
            if($this->data_view->get_active() == 1){
                echo '
                <div class="a006_status_information_active">
                    Активный
                </div> 
                <a href="#" class="a006_status_button" data-id="'.$this->data_view->get_id().'">
                    Деактивировать
                </a>
                ';
            }else{
                echo '
                <div class="a006_status_information_no_active">
                    Не активный
                </div>  
                <a href="#" class="a006_status_button_activate" data-id="'.$this->data_view->get_id().'">
                    Активировать
                </a>
                ';
            }
            ?>
                </div>
            </div>
        </div>

        <div class="a006_ban">
            <div class="a006_ban_wrapper">
                <div class="a006_title_in_user">
                    Бан
                </div>
                <div class="a006_ban_information_wrapper">
<?php
if($this->data_view->get_ban()){
    $ban = $this->data_view->get_ban_reason();
    echo '                      
                    <div class="a006_ban_information_active">
                        '.$ban['reason_ban'].' <br>до '.$ban['expiry_ban'].'
                    </div>      
                    <a href="" class="a006_status_button_unban" data-id="'.$this->data_view->get_id().'">
                        Разбанить
                    </a> ';
}else{
    echo '
<div class="a006_ban_information_no">
    <input class="a006_input_field" type="text" name="reason" placeholder="Введите причину бана">
    <div class="a006_date_wrapper">
        <input class="a006_input_field_data" type="date" id="ban-date" name="ban-date">
        <!-- SVG иконка остаётся как есть -->
    </div>
    <div class="a006_time_wrapper">
        <input class="a006_input_field_time" type="time" id="ban-time" name="ban-time">
        <!-- SVG иконка остаётся как есть -->
    </div>
</div>

                    <a class="a006_status_button_вan a006_status_button_ban" data-id="'.$this->data_view->get_id().'">
                        Забанить
                    </a>           ';
}
?>                                     
                </div>
            </div>
        </div>
</div>

    </form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).on('click', '.a006_status_button, .a006_status_button_activate', function(e) {
    e.preventDefault();
    var userId = $(this).data('id');
    var wrapper = $(this).closest('.a006_status_information_wrapper');
    var isActivate = $(this).hasClass('a006_status_button_activate');
    
    var url = isActivate ? '/ajax/user/active/?id=' + userId : '/ajax/user/noactive/?id=' + userId;
    
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Вставляем уведомление
                $('#box_msg').html(`
                    <div class="a006_toast a006_toast_success">
                        <span class="a006_toast_icon">✔</span>
                        <span class="a006_toast_text">${isActivate ? 'Активация прошла успешно' : 'Деактивация прошла успешно'}</span>
                    </div>
                `);
                
                // Удаляем через 5 секунд
                setTimeout(function() {
                    $('#box_msg').empty();
                }, 2000);
                
                // Обновляем статус (ваш существующий код)
                if (isActivate) {
                    wrapper.html('\
                        <div class="a006_status_information_active">\
                            Активный\
                        </div>\
                        <a href="#" class="a006_status_button" data-id="'+userId+'">\
                            Деактивировать\
                        </a>\
                    ');
                } else {
                    wrapper.html('\
                        <div class="a006_status_information_no_active">\
                            Не активный\
                        </div>\
                        <a href="#" class="a006_status_button_activate" data-id="'+userId+'">\
                            Активировать\
                        </a>\
                    ');
                }
            } else {
                // Показываем ошибку
                $('#box_msg').html(`
                    <div class="a006_toast a006_toast_error">
                        <span class="a006_toast_icon">✖</span>
                        <span class="a006_toast_text">${response.new_status || 'Ошибка операции'}</span>
                    </div>
                `);
                setTimeout(function() {
                    $('#box_msg').empty();
                }, 2000);
            }
        },
        error: function() {
            $('#box_msg').html(`
                <div class="a006_toast a006_toast_error">
                    <span class="a006_toast_icon">✖</span>
                    <span class="a006_toast_text">Ошибка соединения с сервером</span>
                </div>
            `);
            setTimeout(function() {
                $('#box_msg').empty();
            }, 2000);
        }
    });
});


$(document).on('click', '.a006_status_button_ban, .a006_status_button_unban', function(e) {
    e.preventDefault();
    var user_Id = $(this).data('id');
    var wrapper = $(this).closest('.a006_ban_wrapper'); // предполагается, что есть обертка
    var isUnban = $(this).hasClass('a006_status_button_unban');
    
    if (isUnban) {
        // Запрос на разбан
        $.ajax({
            url: '/ajax/user/unban/?id=' + user_Id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                showBanMessage(response, 'Пользователь успешно разбанен');
                if (response.success) {
                    wrapper.html(`
                        <div class="a006_ban_information_no">
                            <input class="a006_input_field" type="text" name="mail" placeholder="Введите причину бана">
                            <div class="a006_date_wrapper">
                                <input class="a006_input_field_data" type="date" id="start" name="trip-start">
                                <svg class="a006_date_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2F6BF2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                            </div>
                            <div class="a006_time_wrapper">
                                <input class="a006_input_field_time" type="time" id="start-time" name="start-time">
                                <svg class="a006_time_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2F6BF2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                            </div>
                        </div>
                        <a href="#" class="a006_status_button_ban" data-id="${user_Id}">
                            Забанить
                        </a>
                    `);
                }
            },
            error: function() {
                $('#box_msg').html(`
                    <div class="a006_toast a006_toast_error">
                        <span class="a006_toast_icon">✖</span>
                        <span class="a006_toast_text">Ошибка соединения с сервером</span>
                    </div>
                `);
                setTimeout(function() {
                    $('#box_msg').empty();
                }, 5000);
            }
        });
    } else {
        // Запрос на бан (собираем данные из формы)
        var reason = wrapper.find('.a006_input_field').val();
        var date = wrapper.find('.a006_input_field_data').val();
        var time = wrapper.find('.a006_input_field_time').val();
        
        if (!reason || !date || !time) {
            $('#box_msg').html(`
                <div class="a006_toast a006_toast_error">
                    <span class="a006_toast_icon">✖</span>
                    <span class="a006_toast_text">Заполните все поля</span>
                </div>
            `);
            setTimeout(function() {
                $('#box_msg').empty();
            }, 5000);
            return;
        }
        
        var expiry = date + ' ' + time;
        
        $.ajax({
            url: '/ajax/user/ban/?id=' + user_Id,
            type: 'POST',
            dataType: 'json',
            data: {
                reason: reason,
                expiry: expiry
            },
            success: function(response) {
                showBanMessage(response, 'Пользователь успешно забанен');
                if (response.success) {
                    wrapper.html(`
                        <div class="a006_ban_information_active">
                            ${response.reason_ban} <br>до ${response.expiry_ban}
                        </div>      
                        <a href="#" class="a006_status_button_unban" data-id="${user_Id}">
                            Разбанить
                        </a>
                    `);
                }
            },
            error: function() {
                $('#box_msg').html(`
                    <div class="a006_toast a006_toast_error">
                        <span class="a006_toast_icon">✖</span>
                        <span class="a006_toast_text">Ошибка соединения с сервером</span>
                    </div>
                `);
                setTimeout(function() {
                    $('#box_msg').empty();
                }, 5000);
            }
        });
    }
});

function showBanMessage(response, successMessage) {
    if (response.success) {
        $('#box_msg').html(`
            <div class="a006_toast a006_toast_success">
                <span class="a006_toast_icon">✔</span>
                <span class="a006_toast_text">${successMessage}</span>
            </div>
        `);
    } else {
        $('#box_msg').html(`
            <div class="a006_toast a006_toast_error">
                <span class="a006_toast_icon">✖</span>
                <span class="a006_toast_text">${response.error || 'Ошибка операции'}</span>
            </div>
        `);
    }
    setTimeout(function() {
        $('#box_msg').empty();
    }, 5000);
}
$(document).ready(function() {
    $('.a006_toast').delay(3000).fadeOut(500, function() {
        $(this).remove();
    });
});
</script>