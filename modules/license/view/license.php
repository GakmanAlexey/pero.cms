<div class="license-agreement-container">
    <h1>Пользовательское соглашение</h1>
    
    <p>Дата вступления в силу: <?php echo \Modules\License\Modul\License::get_effective_date(); ?></p>
    
    <section class="license-section">
        <h2>1. Общие положения</h2>
        <p>Сайт "<?php echo \Modules\License\Modul\License::get_site_name(); ?>" (далее - Сайт) предоставляет услуги на условиях, изложенных в настоящем Соглашении.</p>
        <p>Администратор сайта: <?php echo \Modules\License\Modul\License::get_admin_contact(); ?></p>
        <p>Юридический адрес: <?php echo \Modules\License\Modul\License::get_legal_address(); ?></p>
    </section>

    <section class="license-section">
        <h2>2. Регистрация на сайте</h2>
        <p>2.1. Для использования некоторых функций Сайта требуется регистрация.</p>
        <p>2.2. При регистрации вы обязаны предоставить достоверную информацию.</p>
        <p>2.3. Минимальный возраст пользователя: <?php echo \Modules\License\Modul\License::get_min_age(); ?> лет.</p>
    </section>

    <section class="license-section">
        <h2>3. Обработка персональных данных</h2>
        <p>3.1. Сайт собирает следующие данные: <?php echo \Modules\License\Modul\License::get_collected_data_types(); ?>.</p>
        <p>3.2. Цели обработки данных: <?php echo \Modules\License\Modul\License::get_data_processing_purposes(); ?>.</p>
        <p>3.3. Данные хранятся в течение: <?php echo \Modules\License\Modul\License::get_data_retention_period(); ?>.</p>
    </section>

    <section class="license-section">
        <h2>4. Ответственность</h2>
        <p>4.1. Администрация не несет ответственности за <?php echo \Modules\License\Modul\License::get_disclaimer(); ?>.</p>
    </section>

    <section class="license-section">
        <h2>5. Контакты</h2>
        <p>По вопросам соглашения обращаться: <?php echo \Modules\License\Modul\License::get_support_email(); ?></p>
        <p>Телефон: <?php echo \Modules\License\Modul\License::get_support_phone(); ?></p>
    </section>

    <div class="license-footer">
        <p>© <?php echo date('Y'); ?> <?php echo \Modules\License\Modul\License::get_site_name(); ?>. Все права защищены.</p>
    </div>
</div>