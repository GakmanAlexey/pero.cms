<?php

namespace Modules\Files\Modul;

class Manager{    
   /*
Тип файла	MIME-тип
Изображения	
JPEG/JPG	image/jpeg
PNG	image/png
GIF	image/gif
BMP (Bitmap)	image/bmp
WEBP	image/webp
SVG	image/svg+xml
TIFF	image/tiff
Документы	
PDF	application/pdf
TXT (текстовый)	text/plain
DOC (Word 97-2003)	application/msword
DOCX (Word 2007+)	application/vnd.openxmlformats-officedocument.wordprocessingml.document
XLS (Excel 97-2003)	application/vnd.ms-excel
XLSX (Excel 2007+)	application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
PPT (PowerPoint 97-2003)	application/vnd.ms-powerpoint
PPTX (PowerPoint 2007+)	application/vnd.openxmlformats-officedocument.presentationml.presentation
CSV	text/csv
RTF (Rich Text Format)	application/rtf
Архивы	
ZIP	application/zip
RAR	application/vnd.rar или application/x-rar-compressed
7Z	application/x-7z-compressed
TAR	application/x-tar
GZ	application/gzip
Аудио/Видео	
MP3	audio/mpeg
WAV	audio/wav
MP4 (видео)	video/mp4
AVI	video/x-msvideo
MOV (QuickTime)	video/quicktime
Прочие	
JSON	application/json
XML	application/xml
EXE (исполняемый файл)	application/x-msdownload (не рекомендуется разрешать!)
JS (JavaScript)	application/javascript
CSS	text/css
HTML	text/html
*/
    public function input_files_list($field_name, $upload_dir, $allowed_types = []){
        if (!isset($_FILES[$field_name])) {
            $this->log("Поле файла '$field_name' не найдено в данных формы");
            return null;
        }

        $files_data = $_FILES[$field_name];
        $results = [];

        if (!is_array($files_data['name'])) {
            return [$this->input_file($field_name, $upload_dir, $allowed_types)];
        }

        $file_count = count($files_data['name']);
        for ($i = 0; $i < $file_count; $i++) {
            $single_file = [
                'name' => $files_data['name'][$i],
                'type' => $files_data['type'][$i],
                'tmp_name' => $files_data['tmp_name'][$i],
                'error' => $files_data['error'][$i],
                'size' => $files_data['size'][$i]
            ];

            $_FILES['single_file'] = $single_file;            
            $result = $this->input_file('single_file', $upload_dir, $allowed_types);
            unset($_FILES['single_file']);            
            if ($result !== null) {
                $results[] = $result;
            }
        }

        return !empty($results) ? $results : null;
    }

    public function input_file($field_name,  $upload_dir, $allowed_types = []){
        if (!isset($_FILES[$field_name])) {
            $this->log("Поле файла '$field_name' не найдено в данных формы");
            return null;
        }
        $file_data = $_FILES[$field_name];

        if (!is_uploaded_file($file_data['tmp_name'])) {
            $this->log("Файл не был загружен через HTTP POST");
            return null;
        }

        if ($file_data['error'] !== UPLOAD_ERR_OK) {
            $this->log_upload_error($file_data['error']);
            return null;
        }
        if (!empty($allowed_types)) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $real_mime_type = finfo_file($finfo, $file_data['tmp_name']);
            finfo_close($finfo);            
            if (!in_array($real_mime_type, $allowed_types)) {
                $this->log("Тип файла '{$real_mime_type}' не разрешен");
                return null;
            }
        }

        $real_dir = APP_ROOT.DS.$upload_dir;
        if (!is_dir($real_dir) && !mkdir($real_dir, 0755, true)) {
            $this->log("Не удалось создать директорию '$real_dir'");
            return null;
        }
        $extension = pathinfo($file_data['name'], PATHINFO_EXTENSION);
        $service = new \Modules\Files\Modul\Service;
        $new_file_name = $service->generate_random_filename(40) . ($extension ? '.' . $extension : '');
        $destination = rtrim($upload_dir, '/') . '/' . $new_file_name;
        if (!move_uploaded_file($file_data['tmp_name'], $destination)) {
            $this->log("Не удалось переместить загруженный файл в '$destination'");
            return null;
        }
        $file = new \Modules\Files\Modul\File();
        $file->set_name($file_data['name'])
             ->set_type($file_data['type'])
             ->set_size($file_data['size'])
             ->set_path('/'.$destination)
             ->set_extension($extension)
             ->add_metadata('original_tmp_name', $file_data['tmp_name']);

        if (!$service->save_to_bd($file)) {
            $this->log("Не удалось записать файл в бд");
            @unlink($destination);
            return null;
        }
        return $file;
    }

    private function log_upload_error($error_code){
        $errors = [
            UPLOAD_ERR_INI_SIZE => 'Размер файла превышает значение upload_max_filesize в php.ini',
            UPLOAD_ERR_FORM_SIZE => 'Размер файла превышает указанный MAX_FILE_SIZE в форме',
            UPLOAD_ERR_PARTIAL => 'Файл был загружен только частично',
            UPLOAD_ERR_NO_FILE => 'Файл не был загружен',
            UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная директория для загрузки',
            UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск',
            UPLOAD_ERR_EXTENSION => 'Загрузка файла остановлена расширением PHP',
        ];
        
        $this->log($errors[$error_code] ?? "Неизвестная ошибка загрузки (code $error_code)");
    }
    private function log($message){
        $logger = new \Modules\Core\Modul\Logs();
        $logger->loging('files', $message);
    }

    

}

    
