<?php
namespace Modules\Core\Modul;

class Url 
{
    public static function generate($input, $table, $column){
        $url = self::sanitize($input);
        $counter = 1;
        $original_url = $url;

        while (self::url_exists( $table, $column, $url)) {
            $url = $original_url . '-' . $counter;
            $counter++;
        }
        
        return $url;
    }

    private static function sanitize($str){
        $translit = [
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ъ' => '', 'ы' => 'y', 'ь' => '',
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
            'Ё' => 'Yo', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I', 'Й' => 'Y', 'К' => 'K',
            'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R',
            'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'Ts',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '',
            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya'
        ];
        
        $str = strtr($str, $translit);
        
        $str = preg_replace('/[^a-zA-Z0-9\-]/', '-', $str);
        $str = preg_replace('/\-+/', '-', $str);
        $str = trim($str, '-');
        $str = strtolower($str);
        
        if (strlen($str) > 100) {
            $str = substr($str, 0, 100);
            $str = trim($str, '-');
        }
        
        return $str;
    }

    private static function url_exists($table, $column, $url){
        $pdo = Sql::connect();
        $table_name = Env::get("DB_PREFIX") . $table;
        
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM {$table_name} WHERE {$column} = ?");
        $stmt->execute([$url]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        return $result['count'] > 0;
    }
}