<?php

declare(strict_types=1);

namespace App\MessageBroker\Brokers;

interface MessageBroker
{
    public function publish(array $body, string $queue): void;

    public function consume(string $queue): ?array;
}
