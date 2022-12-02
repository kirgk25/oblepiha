<?php namespace App\Services\Components\Order;

use App\Services\BaseService;

class StorePublisher extends BaseService
{
    public function publish(array $orderProducts, string $queueName): void
    {
        $this->messageBrokerService->publish([
            'userId' => $this->getUserId(),
            'orderProducts' => $orderProducts,
        ], $queueName);
    }
}
