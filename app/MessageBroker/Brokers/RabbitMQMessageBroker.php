<?php

declare(strict_types=1);

namespace App\MessageBroker\Brokers;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQMessageBroker implements MessageBroker
{
    private AMQPStreamConnection $connection;
    private AMQPChannel $channel;

    public function publish(array $body, string $queue): void
    {
        $this->open();
        $this->declareQueue($queue);

        $amqpMessage = new AMQPMessage(json_encode($body));
        $this->channel->basic_publish($amqpMessage, routing_key: $queue);

        $this->close();
    }

    public function consume(string $queue): ?array
    {
        $this->open();
        $this->declareQueue($queue);

        $amqpMessage = $this->channel->basic_get($queue, true);

        $this->close();

        return $amqpMessage
            ? json_decode($amqpMessage->body, true)
            : null;
    }

    private function open(): void
    {
        $host = config('rabbitmq.host');
        $port = config('rabbitmq.port');
        $user = config('rabbitmq.user');
        $password = config('rabbitmq.password');

        $this->connection = new AMQPStreamConnection($host, $port, $user, $password);
        $this->channel = $this->connection->channel();
    }

    private function close(): void
    {
        $this->channel->close();
        $this->connection->close();
    }

    private function declareQueue(string $queue): void
    {
        $this->channel->queue_declare($queue, auto_delete: true);
    }
}
