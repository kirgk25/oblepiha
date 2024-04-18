<?php

namespace App\Services;

interface MessageBrokerService
{
    public function publish(array $body, string $queue): void;
    public function consume(string $queue): ?array;
}
