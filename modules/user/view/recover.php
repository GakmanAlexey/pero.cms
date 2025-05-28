
 <div class="b005_login full_height_wrapper">
        <div class="container">
            <div class="b005_login_box">
                <div class="b005_title_block">
                    Востановление пароля
                </div>
                <div class="b005_discription">
                    Укажите логин, на который зарегистрирован ваш аккаунт, и мы отправим ссылку для сброса пароля. Если у вас нет аккаунта, <a href="/user/register/" class="b005_link">Зарегистрируйтесь</a>
                </div>

                <form class="b005_form_login" id="loginForm" novalidate method="post" action="/user/recover/">
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

                    }?>
                    


                    <a href="/user/login/" class="b005_link">Вернуться к входу</a>

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
