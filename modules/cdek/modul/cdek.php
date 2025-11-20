<?php

namespace Modules\Cdek\Modul;

class Cdek{
    function calculatePackageDimensions($card) {
        $products = $card->get_product_list();
        $boxes = [];
        $total_weight = 0;
        
        foreach ($products as $product) {
            for ($i = 0; $i < $product->get_count_buy_in_card(); $i++) {
                $boxes[] = [
                    'width' => $product->get_width(),
                    'height' => $product->get_height(),
                    'length' => $product->get_length(),
                    'volume' => $product->get_width() * $product->get_height() * $product->get_length(),
                    'weight' => $product->get_weight()
                ];
            }
            // Суммируем общий вес
            $total_weight += $product->get_weight() * $product->get_count_buy_in_card();
        }

        usort($boxes, function($a, $b) {
            return $b['volume'] <=> $a['volume'];
        });
        
        $dimensions = $this->calculateOptimalBox($boxes);
        $dimensions['weight'] = $total_weight;
        
        return $dimensions;
    }
    
    function calculateOptimalBox($boxes) {
        if (empty($boxes)) {
            return ['width' => 0, 'height' => 0, 'length' => 0, 'volume' => 0, 'weight' => 0];
        }
        
        // Начинаем с первого товара
        $total = [
            'width' => $boxes[0]['width'],
            'height' => $boxes[0]['height'], 
            'length' => $boxes[0]['length']
        ];
        
        // Добавляем остальные товары, увеличивая соответствующие размеры
        for ($i = 1; $i < count($boxes); $i++) {
            $box = $boxes[$i];
            
            // Находим наилучшую сторону для добавления
            $dimensions = ['width', 'height', 'length'];
            $increase = [
                'width' => $total['width'] + $box['width'],
                'height' => $total['height'] + $box['height'],
                'length' => $total['length'] + $box['length']
            ];
            
            // Выбираем вариант с минимальным объемом
            $volumes = [];
            foreach ($dimensions as $dim) {
                $temp = $total;
                $temp[$dim] = $increase[$dim];
                $volumes[$dim] = $temp['width'] * $temp['height'] * $temp['length'];
            }
            
            $best_dimension = array_keys($volumes, min($volumes))[0];
            $total[$best_dimension] = $increase[$best_dimension];
        }
        
        // Сортируем размеры по возрастанию (требование СДЭК)
        $sorted = [$total['width'], $total['height'], $total['length']];
        sort($sorted);
        
        return [
            'width' => $sorted[0],   // наименьшая сторона
            'height' => $sorted[1],  // средняя сторона  
            'length' => $sorted[2],  // наибольшая сторона
            'volume' => $sorted[0] * $sorted[1] * $sorted[2]
        ];
    }
    
    // Альтернативный метод с учетом объемного веса (для СДЭК)
    function calculateWithVolumetricWeight($card) {
        $dimensions = $this->calculatePackageDimensions($card);
        
        // Рассчитываем объемный вес (СДЭК использует коэффициент 250)
        $volumetric_weight = ceil($dimensions['volume'] / 250);
        
        // Итоговый вес - максимальный из реального и объемного
        $final_weight = max($dimensions['weight'], $volumetric_weight);
        
        return [
            'width' => $dimensions['width'],
            'height' => $dimensions['height'],
            'length' => $dimensions['length'],
            'volume' => $dimensions['volume'],
            'weight' => $dimensions['weight'],
            'volumetric_weight' => $volumetric_weight,
            'final_weight' => $final_weight
        ];
    }
    
    // Метод для получения данных в формате СДЭК API
    function getSdekPackageData($card) {
        $package_data = $this->calculateWithVolumetricWeight($card);
        
        // Округляем размеры до целых (требование СДЭК)
        return [
            'weight' => ceil($package_data['final_weight']), // в граммах
            'length' => ceil($package_data['length']),       // в см
            'width' => ceil($package_data['width']),         // в см  
            'height' => ceil($package_data['height']),       // в см
            'volume' => $package_data['volume']              // в см³
        ];
    }
    
    // Вспомогательный метод для проверки минимальных размеров
    function applyMinimumDimensions($dimensions) {
        // Минимальные размеры для СДЭК
        $min_width = 5;   // см
        $min_height = 5;  // см  
        $min_length = 5;  // см
        $min_weight = 1;  // кг
        
        return [
            'width' => max($dimensions['width'], $min_width),
            'height' => max($dimensions['height'], $min_height),
            'length' => max($dimensions['length'], $min_length),
            'weight' => max($dimensions['weight'], $min_weight),
            'volume' => $dimensions['volume']
        ];
    }
}