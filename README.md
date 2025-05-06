# Pero.CMS

Простая и быстрая CMS для разработчиков

## Структура проекта

```markdown
/home/redlava/webserver/pero.cms/
├── cache/ # Кэш системы
├── logs/ # Логи приложения
├── upload/ # Загружаемые файлы
├── Modules/ # Модули системы
├── src/ # Исходный код
├── .env # Конфигурация окружения
├── index.php # Точка входа
├── nginx.conf # Конфиг Nginx
├── .htaccess # Настройки Apache
├── permissions.conf # Инструкция по правам
├── fix_prod_perms.sh # Скрипт прав для production
├── fix_dev_perms.sh # Скрипт прав для development
└── README.md # Этот файл

```

## План проекта к версии 0.2

```markdown
[   ] Модуль USER
[   ] Модуль GROUP
[   ] Модуль EMAIL
[   ] Модуль TG
[   ] Модуль PERMISSION
[   ] Модуль TOOLS - требуюмые инструменты

```

## TODO

```markdown
[   ] события в модуле USER

```
## 🛠 Настройка окружения

### 1. Права доступа

Перед запуском установите правильные права:

```bash
# Дайте права на выполнение скриптов
chmod +x fix_*_perms.sh

# Для production-окружения
sudo ./fix_prod_perms.sh

# Для development-окружения
sudo ./fix_dev_perms.sh
```