<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Order;
use App\Services\Components\Order\StorePublisher;
use App\Services\Components\Order\StoreConsumer;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService extends BaseService
{
    public const STATUS_CREATED = 1;
    public const STATUS_ASSEMBLE = 2;
    public const STATUS_EN_ROUTE = 3;
    public const STATUS_WAIT = 4;
    public const STATUS_DELIVERED = 5;
    public const STATUS_CANCELLED = 6;

    public const QUEUE_STORE = 'orders.store';

    public function index(): LengthAwarePaginator
    {
        $orders = $this->getUser()
            ->orders()
            ->orderByDesc('id')
            ->with('orderProducts.product')
            ->paginate(2);

        return $orders;
    }

    public function store(): void
    {
        $storePublisher = new StorePublisher();
        $orderProducts = request()->orderProducts;

        $storePublisher->publish($orderProducts, self::QUEUE_STORE);
    }

    public function consumeStore(): ?Order
    {
        return new StoreConsumer()->consume(self::QUEUE_STORE);
    }
}
