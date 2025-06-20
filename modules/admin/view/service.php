<div class="a021_header_block">
    <div class="a021_header_title">Сервисы</div>
</div>

<div class="a021_service_card">
    <div class="a021_service_card_left">
        <img class="a021_service_icon" src="/image.png" alt="Логотип сервиса">
        <div class="a021_service_info">
            <div class="a021_service_name">Робокасса</div>
            <div class="a021_service_description">
                Удобный и надёжный сервис для интеграции с сайтом. Позволяет автоматизировать процессы, повысить удобство работы и сэкономить время. Поддерживает гибкие настройки и прост в подключении.
            </div>
        </div>
    </div>
    <div class="a021_service_btn">
        <a href="" class="a021_service_save_btn">
            Сохранить
        </a>
    </div>
</div>

<div class="a021_loading_wrap" id="result">
    <div class="a021_loading"  id="resul2t">
        <div class="a021_loading_spinner"></div>
    </div>    
    <div class="a021_modal a021_modal_success" id="modal-success">
        <div class="a021_modal_content">
            <button class="a021_modal_close" aria-label="Закрыть">×</button>
            <h3 class="a021_modal_title">Успешно!</h3>
            <p class="a021_modal_text">Данные были успешно загружены.</p>
            <button class="a021_modal_button">Принять</button>
        </div>
    </div>
<!-- Ошибка -->
<div class="a021_modal a021_modal_error" id="modal-error">
  <div class="a021_modal_content">
    <button class="a021_modal_close" aria-label="Закрыть">×</button>
    <h3 class="a021_modal_title">Ошибка!</h3>
    <p class="a021_modal_text">Произошла ошибка при загрузке данных.</p>
    <button class="a021_modal_button">Принять</button>
  </div>
</div>

<!-- Предупреждение -->
<div class="a021_modal a021_modal_warning" id="modal-warning">
  <div class="a021_modal_content">
    <button class="a021_modal_close" aria-label="Закрыть">×</button>
    <h3 class="a021_modal_title">Внимание!</h3>
    <p class="a021_modal_text">Некоторые поля заполнены некорректно.</p>
    <button class="a021_modal_button">Принять</button>
  </div>
</div>
</div>

<script>
    document.getElementById('resul2t').style.display = 'flex';
</script>

