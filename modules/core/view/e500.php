

<div class="b004_error full_height_wrapper">
    <div class="container">
        <div class="b004_error_hero_wrapper">
            <div class="b004_error_hero_duble">
                <h1 class="b004_error_hero_title">500</h1>           
            </div>
            <div class="b004_error_hero">
                <h3 class="b004_error_hero_subheading">Перо споткнулось о что-то серьёзное.</h3>
                <p class="b004_error_hero_dicription">Внутри что-то пошло не так. Мы уже открыли чернильницу, чтобы всё исправить. Попробуйте обновить страницу чуть позже.</p>
                <a class="b004_error_hero_btn">На главную</a>
            </div>
        </div>

        <div class="b004_error_hero_notification">
<?php
echo '<pre>' . htmlspecialchars($this->data["error_msg"]['error_message'] ?? 'Unknown error') . '</pre>';
if (isset($this->data["error_msg"]['exception'])) {
    echo '<h3>Exception Details:</h3>';
    echo '<pre>';
    echo htmlspecialchars((string) $this->data["error_msg"]['exception']);
    echo '</pre>';
}
?>
        </div>
    </div>
</div>