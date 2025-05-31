<div class="b003_main_screen">
  <canvas id="myCanvas"></canvas>
    <div class="container">
        <div class="b003_main_screen_hero_wrapper">
            <div class="b003_main_screen_hero">
                <h1 class="b003_main_screen_hero_title">Ваша идея — наш код. Мы превращаем мысли в сайты.</h1>
                <p class="b003_main_screen_hero_dicription">Создаём сайты, которые работают на ваш бизнес: быстро, стильно и без шаблонных решений. Разработка под задачу, а не «как у всех».</p>
                <a class="b003_main_screen_hero_btn">Начать</a>
            </div>
        </div>
    </div>
</div>


<?php
/*
// Если форма была отправлена - обрабатываем загрузку
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Подключаем класс для загрузки (замените на ваш реальный путь)
    $uploader = new \Modules\Files\Modul\Manager();
    
    // Разрешенные типы файлов
    $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];
    $upload_dir = 'upload';
    
    $results = [];
    
    // Обработка одиночного файла
    if (!empty($_FILES['single_file'])) {
        $file = $uploader->input_file('single_file', $upload_dir, $allowed_types);
        $results['single'] = $file ?: 'Ошибка загрузки';
    }
    
    // Обработка нескольких файлов
    if (!empty($_FILES['multiple_files'])) {
        $files = $uploader->input_files_list('multiple_files', $upload_dir, $allowed_types);
        $results['multiple'] = $files ?: 'Ошибка загрузки';
    }
}
?>

<h1>Тест загрузки файлов</h1>
    
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Одиночный файл:</label>
            <input type="file" name="single_file">
        </div>
        
        <div class="form-group">
            <label>Несколько файлов:</label>
            <input type="file" name="multiple_files[]" multiple>
        </div>
        
        <button type="submit">Загрузить</button>
    </form>
    
    <?php if (!empty($results)): ?>
        <div class="result <?php echo isset($results['error']) ? 'error' : 'success'; ?>">
            <h2>Результат:</h2>
            <?php if (isset($results['single'])): ?>
                <h3>Одиночный файл:</h3>
                <?php if (is_string($results['single'])): ?>
                    <p class="error"><?= $results['single'] ?></p>
                <?php else: ?>
                    <p>Успешно: <?= htmlspecialchars($results['single']->get_name()) ?></p>
                    <p>Тип: <?= htmlspecialchars($results['single']->get_type()) ?></p>
                <?php endif; ?>
            <?php endif; ?>
            
            <?php if (isset($results['multiple'])): ?>
                <h3>Несколько файлов:</h3>
                <?php if (is_string($results['multiple'])): ?>
                    <p class="error"><?= $results['multiple'] ?></p>
                <?php else: ?>
                    <ul>
                        <?php foreach ($results['multiple'] as $file): ?>
                            <li><?= htmlspecialchars($file->get_name()) ?> (<?= $file->get_size() ?> байт)</li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endif; */ ?>