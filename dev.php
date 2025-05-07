#!/usr/bin/env php
<?php
function install() {   
    echo "стартовал процесс установки\n";
}

function create($moduleName) {
    echo "Creating module '$moduleName'...\n";
    // Логика создания модуля
    echo "Module '$moduleName' created!\n";
}

function sql() {
    echo "Executing SQL: $query\n";
    // Логика выполнения SQL
    echo "Query executed!\n";
}


function help() {
    echo "Available commands:\n";
    echo "  install           - Установка системы\n";
    echo "  create <name>     - Создание нового модуля\n";
    echo "  sql               - Импорт sql\n";
    echo "  help              - показывает команды помощи\n";
}

$command = $argv[1] ?? null;

switch ($command) {
    case 'install':
        install();
        break;
        
    case 'create':
        $moduleName = $argv[2] ?? null;
        if ($moduleName) {
            create($moduleName);
        } else {
            echo "ошибка: отсутсвует название модуля!\n";
        }
        break;
        
    case 'sql':
        sql();
        break;

        
    case 'help':
    default:
        help();
        break;
}
?>