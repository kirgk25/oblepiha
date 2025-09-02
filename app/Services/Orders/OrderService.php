<?php

declare(strict_types=1);

namespace App\Services\Orders;

use App\Models\Orders\Order;
use App\Repositories\Orders\OrderRepository;
use App\Services\BaseService;
use App\MessageBroker\Publishers\Orders\StorePublisher;
use App\MessageBroker\Consumers\Orders\StoreConsumer;
use Illuminate\Pagination\LengthAwarePaginator;

final class OrderService extends BaseService
{
    public function __construct(
        private readonly OrderRepository $orderRepository,
        private readonly StorePublisher $storePublisher,
    ) {
        parent::__construct();
    }

    public function index(): LengthAwarePaginator
    {
        return $this
            ->orderRepository
            ->index($this->getUser());
    }

    public function store(): void
    {
        $userId = $this->getUserId();
        $orderProducts = request()->orderProducts;

        $this
            ->storePublisher
            ->publish($orderProducts, $userId);
    }

    public function consumeStore(): ?Order
    {
        return new StoreConsumer()->consume();
    }
}
