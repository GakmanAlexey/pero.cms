
 <div class="b005_login full_height_wrapper">
        <div class="container">
            <div class="b005_login_box">
                <div class="b005_title_block">
                    Вход
                </div>
                <div class="b005_discription">
                    войдите в аккаунт при помощи логина и пароля, если у вас нет аккаунта, <a href="/user/register/" class="b005_link">Зарегистрируйтесь</a>
                </div>

                <form class="b005_form_login" id="loginForm" novalidate method="post" action="/user/login/">
                    <?php
                    if(\Modules\User\Modul\Msg::$type == "username") {
                        ?>
                    <div class="b005_input_wrapper">
                        <input class="b005_input error" type="text" placeholder="Логин" name="username">
                        <div class="b005_error_message show"><?php foreach(\Modules\User\Modul\Msg::$msg as $item){echo $item;}?></div>
                    </div>
                    <?php
                    }else{
                        ?>
                    <div class="b005_input_wrapper">
                        <input class="b005_input" type="text" placeholder="Логин" name="username">
                        <div class="b005_error_message "></div>
                    </div>
                    <?php

                    }
                    if(\Modules\User\Modul\Msg::$type == "password") {
                        ?>
                   <div class="b005_input_wrapper">
                        <div class="b005_password_wrapper ">
                            <input class="b005_input error" type="password" placeholder="Пароль" name="password" id="passwordField">
                            <button type="button" class="b005_toggle_password" id="togglePassword" aria-label="Показать пароль">
                            <svg class="eye_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2F6BF2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/>
                                <circle cx="12" cy="12" r="3"/>
                                <line class="eye_slash" x1="3" y1="3" x2="21" y2="21"/>
                            </svg>
                            </button>
                        </div>
                        <div class="b005_error_message show"><?php foreach(\Modules\User\Modul\Msg::$msg as $item){echo $item;}?></div>
                    </div>
                    <?php
                    }else{
                        ?>
                    <div class="b005_input_wrapper">
                        <div class="b005_password_wrapper">
                            <input class="b005_input" type="password" placeholder="Пароль" name="password" id="passwordField">
                            <button type="button" class="b005_toggle_password" id="togglePassword" aria-label="Показать пароль">
                            <svg class="eye_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2F6BF2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/>
                                <circle cx="12" cy="12" r="3"/>
                                <line class="eye_slash" x1="3" y1="3" x2="21" y2="21"/>
                            </svg>
                            </button>
                        </div>
                        <div class="b005_error_message"></div>
                    </div>
                    <?php

                    }?>


                    <a href="/user/recover/" class="b005_link">Забыли пароль?</a>

                    <button type="submit" class="b005_btn_form" value="auth" name="auth_button">Отправить</button>
                </form>

            </div>
        </div>
    </div>

   <script>
const toggleButton = document.getElementById('togglePassword');
const passwordField = document.getElementById('passwordField');
const eyeIcon = toggleButton.querySelector('.eye_icon');

toggleButton.addEventListener('click', () => {
  const isHidden = passwordField.type === 'password';
  passwordField.type = isHidden ? 'text' : 'password';
  eyeIcon.classList.toggle('no_slash', isHidden);
});
</script>
