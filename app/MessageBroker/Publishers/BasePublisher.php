<?php

declare(strict_types=1);

namespace App\MessageBroker\Publishers;

use App\MessageBroker\Brokers\MessageBroker;

class BasePublisher
{
    public function __construct(
        protected readonly MessageBroker $messageBroker,
    ) {}
}
