<?php

declare(strict_types=1);

namespace App\MessageBroker\Publishers\Orders;

use App\Enums\Common\MessageBroker\MessageBrokerQueueEnum;
use App\MessageBroker\Publishers\BasePublisher;

class StorePublisher extends BasePublisher
{
    public function publish(array $orderProducts, int $userId): void
    {
        $this->messageBroker->publish([
            'userId' => $userId,
            'orderProducts' => $orderProducts,
        ], MessageBrokerQueueEnum::OrdersStore->value);
    }
}
