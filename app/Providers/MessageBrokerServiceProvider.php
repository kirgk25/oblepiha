<?php

namespace App\Providers;

use App\Services\Components\MessageBroker\RabbitMQService;
use App\Services\MessageBrokerService;
use Illuminate\Support\ServiceProvider;

class MessageBrokerServiceProvider extends ServiceProvider
{
    public array $singletons = [
        MessageBrokerService::class => RabbitMQService::class,
    ];
}
