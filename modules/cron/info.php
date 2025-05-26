<?php
return [
    // Основная информация о модуле
    'module' => [
        'name'        => 'Инструменты',
        'description' => 'Модуль инструментов',
        'version'     => '0.1.0',
        'icon'        => '/modules/tools/src/icon.svg', 
    ],

    // Информация о разработчике
    'author' => [
        'name'    => 'Jaligwei',
        'email'   => 'test@example.com',
        'website' => 'https://example.com',
    ],

    // Системные требования
    'requirements' => [
        'php'       => '7.4+',
        'extensions' => ['pdo',],
        'cms_version' => '0.0+',
    ],

    // Зависимости от других модулей
    'dependencies' => [
        [
            'name'    => 'Users',
            'version' => '1.2.0+',
        ],
        [
            'name'    => 'SEO',
            'version' => '2.0.0+',
        ],
    ],

    // Права доступа (permissions)
    'permissions' => [
        'blog_view' => [
            'title' => 'Просмотр статей',
            'description' => 'Доступ к списку статей и чтению',
        ],
        'blog_manage' => [
            'title' => 'Управление статьями',
            'description' => 'Создание, редактирование и удаление статей',
        ],
    ],

    // Инструкция по установке
    'install' => [
        'copy_files_to' => '/modules/core/',
        'run_migrations' => true,
    ],

    // Дополнительные настройки (опционально)
    'settings' => [
        'default_pagination' => 10,
        'enable_comments'   => true,
    ],
];