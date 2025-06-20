
<div class="a021_modal a021_modal_success show" id="modal-success">
        <div class="a021_modal_content">
            <button class="a021_modal_close" aria-label="Закрыть">×</button>
            <h3 class="a021_modal_title">Успешно!</h3>
            <p class="a021_modal_text">Собраны все компоненты относящиеся к админестративному интерфейсу</p>
            <button class="a021_modal_button">Принять</button>
        </div>
    </div>
    <script>
        $(document).ready(function() {
    // Обработчик для кнопки "Закрыть" (×)
    $('.a021_modal_close').on('click', function() {
        $('#modal-success').remove();
    });
    
    // Обработчик для кнопки "Принять"
    $('.a021_modal_button').on('click', function() {
        $('#modal-success').remove();
    });
});
</script>