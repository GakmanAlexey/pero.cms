<?php

namespace Modules\Payment\Module;

class Status
{
    private $statuses = [];
    
    public function __construct()
    {
        $this->initStatuses();
    }
    
    private function initStatuses(): void
    {
        $this->statuses = [
            // Основные статусы
            1 => ['id' => 1, 'code' => 'new', 'name' => "Новый", 'is_final' => false],
            2 => ['id' => 2, 'code' => 'pending', 'name' => "Ожидание оплаты", 'is_final' => false],
            3 => ['id' => 3, 'code' => 'processing', 'name' => "В обработке", 'is_final' => false],
            
            // Успешные статусы
            4 => ['id' => 4, 'code' => 'paid', 'name' => "Оплачен", 'is_final' => true],
            5 => ['id' => 5, 'code' => 'completed', 'name' => "Завершен", 'is_final' => true],
            6 => ['id' => 6, 'code' => 'confirmed', 'name' => "Подтвержден", 'is_final' => true],
            
            // Статусы для наличной оплаты
            7 => ['id' => 7, 'code' => 'waiting_cash', 'name' => "Ожидание наличной оплаты", 'is_final' => false],
            8 => ['id' => 8, 'code' => 'cash_collected', 'name' => "Наличные получены", 'is_final' => true],
            9 => ['id' => 9, 'code' => 'waiting_pickup', 'name' => "Ожидание самовывоза", 'is_final' => false],
            10 => ['id' => 10, 'code' => 'ready_for_pickup', 'name' => "Готов к выдаче", 'is_final' => false],
            
            // Проблемные статусы
            11 => ['id' => 11, 'code' => 'failed', 'name' => "Ошибка оплаты", 'is_final' => true],
            12 => ['id' => 12, 'code' => 'cancelled', 'name' => "Отменен", 'is_final' => true],
            13 => ['id' => 13, 'code' => 'expired', 'name' => "Время истекло", 'is_final' => true],
            14 => ['id' => 14, 'code' => 'declined', 'name' => "Отклонен", 'is_final' => true],
            
            // Возвраты
            15 => ['id' => 15, 'code' => 'refunded', 'name' => "Возврат средств", 'is_final' => true],
            16 => ['id' => 16, 'code' => 'partially_refunded', 'name' => "Частичный возврат", 'is_final' => true],
            17 => ['id' => 17, 'code' => 'refund_pending', 'name' => "Ожидание возврата", 'is_final' => false],
            
            // Холдирование (для двухстадийных платежей)
            18 => ['id' => 18, 'code' => 'authorized', 'name' => "Средства заблокированы", 'is_final' => false],
            19 => ['id' => 19, 'code' => 'hold', 'name' => "Средства заморожены", 'is_final' => false],
            
            // Дополнительные статусы
            20 => ['id' => 20, 'code' => 'on_hold', 'name' => "На удержании", 'is_final' => false],
            21 => ['id' => 21, 'code' => 'awaiting_confirmation', 'name' => "Ожидание подтверждения", 'is_final' => false],
        ];
    }
    
    public function getAll(): array
    {
        return $this->statuses;
    }
    
    public function getByCode(string $code): ?array
    {
        foreach ($this->statuses as $status) {
            if ($status['code'] === $code) {
                return $status;
            }
        }
        return null;
    }
    
    public function getById(int $id): ?array
    {
        return $this->statuses[$id] ?? null;
    }
    
    public function getFinalStatuses(): array
    {
        return array_filter($this->statuses, function($status) {
            return $status['is_final'];
        });
    }
    
    public function getNonFinalStatuses(): array
    {
        return array_filter($this->statuses, function($status) {
            return !$status['is_final'];
        });
    }
    
    /**
     * Статусы для онлайн оплаты
     */
    public function getOnlinePaymentStatuses(): array
    {
        $onlineCodes = ['new', 'pending', 'processing', 'paid', 'failed', 'authorized', 'hold'];
        return $this->getByCodes($onlineCodes);
    }
    
    /**
     * Статусы для наличной оплаты
     */
    public function getCashPaymentStatuses(): array
    {
        $cashCodes = ['new', 'waiting_cash', 'cash_collected', 'waiting_pickup', 'ready_for_pickup', 'cancelled'];
        return $this->getByCodes($cashCodes);
    }
    
    /**
     * Основной workflow для онлайн платежей
     */
    public function getOnlineWorkflow(): array
    {
        return [
            'new' => ['pending', 'processing', 'cancelled'],
            'pending' => ['processing', 'paid', 'failed', 'cancelled'],
            'processing' => ['paid', 'failed', 'cancelled'],
            'authorized' => ['confirmed', 'refunded', 'cancelled'],
            'paid' => ['refunded', 'partially_refunded', 'completed'],
            'completed' => ['refunded', 'partially_refunded'],
        ];
    }
    
    /**
     * Workflow для наличной оплаты с самовывозом
     */
    public function getCashPickupWorkflow(): array
    {
        return [
            'new' => ['waiting_cash', 'waiting_pickup', 'cancelled'],
            'waiting_cash' => ['cash_collected', 'waiting_pickup', 'cancelled'],
            'waiting_pickup' => ['ready_for_pickup', 'cash_collected', 'cancelled'],
            'ready_for_pickup' => ['completed', 'cash_collected'],
            'cash_collected' => ['completed'],
        ];
    }
    
    /**
     * Проверка возможности перехода между статусами
     */
    public function canChangeStatus(string $from, string $to, string $paymentType = 'online'): bool
    {
        $workflow = $paymentType === 'cash' ? $this->getCashPickupWorkflow() : $this->getOnlineWorkflow();
        
        return isset($workflow[$from]) && in_array($to, $workflow[$from]);
    }
    
    private function getByCodes(array $codes): array
    {
        return array_filter($this->statuses, function($status) use ($codes) {
            return in_array($status['code'], $codes);
        });
    }
    
    /**
     * Получить статусы для select dropdown
     */
    public function getForSelect(): array
    {
        $result = [];
        foreach ($this->statuses as $status) {
            $result[$status['id']] = $status['name'];
        }
        return $result;
    }
    
    /**
     * Получить коды статусов для select dropdown
     */
    public function getCodesForSelect(): array
    {
        $result = [];
        foreach ($this->statuses as $status) {
            $result[$status['code']] = $status['name'];
        }
        return $result;
    }
}