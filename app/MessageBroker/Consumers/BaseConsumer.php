<?php

declare(strict_types=1);

namespace App\MessageBroker\Consumers;

use App\MessageBroker\Brokers\MessageBroker;

class BaseConsumer
{
    public function __construct(
        protected readonly MessageBroker $messageBroker,
    ) {}
}
