 <div class="b005_login full_height_wrapper">
        <div class="container">
            <div class="b005_registr_box">
                <div class="b005_title_block">
                    Регистрация
                </div>
                <div class="b005_discription">
                    Зарегистрируйтесь на сайте, если у вас уже есть аккаунт, <a href="b005_link" class="">Войдите</a>
                </div>

                <form class="b005_form_login" id="loginForm" novalidate>
                    <div class="b005_input_wrapper">
                        <input class="b005_input error" type="text" placeholder="Логин" name="login">
                        <div class="b005_error_message show">введен не корректный логин</div>
                    </div>

                     <div class="b005_input_wrapper">
                        <input class="b005_input error" type="email" placeholder="Почта" name="email">
                        <div class="b005_error_message show">введен не корректный логин</div>
                    </div>
                <div class="b005_password_wrapper">
                    <input class="b005_input password-input" type="password" placeholder="Пароль">
                    <button type="button" class="b005_toggle_password" aria-label="Показать пароль">
                        <svg class="eye_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="#2F6BF2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z" />
                        <circle cx="12" cy="12" r="3" />
                        <line class="eye_slash" x1="3" y1="3" x2="21" y2="21" />
                        </svg>
                    </button>
                </div>

                <div class="b005_password_wrapper">
                    <input class="b005_input password-input" type="password" placeholder="Повторите пароль">
                    <button type="button" class="b005_toggle_password" aria-label="Показать пароль">
                        <svg class="eye_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                        stroke="#2F6BF2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z" />
                        <circle cx="12" cy="12" r="3" />
                        <line class="eye_slash" x1="3" y1="3" x2="21" y2="21" />
                        </svg>
                    </button>
                </div>

                    <button type="submit" class="b005_btn_form">Отправить</button>
                </form>

            </div>
        </div>
    </div>

  <script>
  const passwordInputs = document.querySelectorAll('.password-input');
  const toggleButtons = document.querySelectorAll('.b005_toggle_password');

  toggleButtons.forEach(button => {
    button.addEventListener('click', () => {
      const show = passwordInputs[0].type === 'password';
      passwordInputs.forEach(input => {
        input.type = show ? 'text' : 'password';
      });

      // Обновим все SVG иконки
      toggleButtons.forEach(btn => {
        const eye = btn.querySelector('.eye_icon');
        eye.classList.toggle('no_slash', show);
      });
    });
  });
</script>
