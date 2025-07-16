<?php

declare(strict_types=1);

namespace App\Services;

interface MessageBrokerService
{
    public function publish(array $body, string $queue): void;
    public function consume(string $queue): ?array;
}
