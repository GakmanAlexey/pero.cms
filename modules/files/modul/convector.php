<?php

namespace Modules\Files\Modul;

class Convector{    
    
    public function webp(\Modules\Files\Modul\File $file, $quality = 80){

        if (!$file->is_file_image()) {
            throw new \RuntimeException("Файл не является изображением");
        }
        $original_path = $file->get_path();
        $new_path = pathinfo($original_path, PATHINFO_DIRNAME) . DS . 
                  pathinfo($original_path, PATHINFO_FILENAME) . '.webp';


        $image = $this->create_image_from_file($file);

        if (!imagewebp($image, $new_path, $quality)) {
            imagedestroy($image);
            throw new \RuntimeException("Ошибка при конвертации в WebP");
        }

        imagedestroy($image);

        return $file
            ->set_path($new_path)
            ->set_type('image/webp')
            ->set_extension('webp')
            ->add_metadata('original_type', $file->get_type())
            ->add_metadata('converted_to_webp', date('Y-m-d H:i:s'))
            ->add_metadata('webp_quality', $quality);

    }

    private function create_image_from_file(\Modules\Files\Modul\File $file){
        switch ($file->get_type()) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($file->get_path());
                break;
            case 'image/png':
                $image = imagecreatefrompng($file->get_path());
                imagepalettetotruecolor($image);
                imagealphablending($image, true);
                imagesavealpha($image, true);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($file->get_path());
                imagepalettetotruecolor($image);
                break;
            case 'image/bmp':
            case 'image/x-ms-bmp':
                $image = $this->imagecreatefrombmp($file->get_path());
                break;
            default:
                throw new \RuntimeException("Неподдерживаемый тип изображения: " . $file->get_type());
        }

        if ($image === false) {
            throw new \RuntimeException("Не удалось создать изображение из файла");
        }

        return $image;
    }

    private function imagecreatefrombmp($filename)
    {
        $file = fopen($filename, 'rb');
        if (!$file) {
            throw new \RuntimeException("Не удалось открыть BMP файл");
        }

        $header = unpack('vtype/Vsize/Vreserved/Voffset', fread($file, 14));
        $info = unpack('Vsize/Vwidth/Vheight/vplanes/vbits/Vcompression/Vimagesize/Vxres/Vyres/Vncolor/Vimportant', fread($file, 40));

        if ($header['type'] != 0x4D42 || $info['bits'] != 24 || $info['compression'] != 0) {
            fclose($file);
            throw new \RuntimeException("Поддерживаются только 24-битные несжатые BMP файлы");
        }

        $image = imagecreatetruecolor($info['width'], $info['height']);
        if (!$image) {
            fclose($file);
            throw new \RuntimeException("Не удалось создать GD ресурс");
        }

        $lineLength = $info['width'] * 3;
        $padLength = (4 - ($lineLength % 4)) % 4;

        fseek($file, $header['offset']);

        for ($y = $info['height'] - 1; $y >= 0; $y--) {
            $line = fread($file, $lineLength);
            if ($line === false) {
                continue;
            }

            $pixels = str_split($line, 3);
            
            foreach ($pixels as $x => $pixel) {
                $color = imagecolorallocate(
                    $image,
                    ord($pixel[2]),
                    ord($pixel[1]),
                    ord($pixel[0])
                );
                imagesetpixel($image, $x, $y, $color);
            }
            
            if ($padLength > 0) {
                fread($file, $padLength);
            }
        }

        fclose($file);
        return $image;
    }

}

    
