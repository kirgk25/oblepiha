<?php

declare(strict_types=1);

namespace App\Enums\Common\MessageBroker;

enum MessageBrokerQueueEnum: string
{
    case OrdersStore = 'orders.store';
}
