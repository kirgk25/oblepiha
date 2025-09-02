<?php

declare(strict_types=1);

namespace App\Providers;

use App\MessageBroker\Brokers\RabbitMQMessageBroker;
use App\MessageBroker\Brokers\MessageBroker;
use Illuminate\Support\ServiceProvider;

class MessageBrokerServiceProvider extends ServiceProvider
{
    public array $singletons = [
        MessageBroker::class => RabbitMQMessageBroker::class,
    ];
}
