<?php namespace App\Services;

use App\Models\Order;
use App\Services\Components\Order\StorePublisher;
use App\Services\Components\Order\StoreConsumer;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService extends BaseService
{
    const STATUS_CREATED = 1;
    const STATUS_ASSEMBLE = 2;
    const STATUS_EN_ROUTE = 3;
    const STATUS_WAIT = 4;
    const STATUS_DELIVERED = 5;
    const STATUS_CANCELLED = 6;

    const QUEUE_STORE = 'orders.store';

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
        return (new StoreConsumer())->consume(self::QUEUE_STORE);
    }
}
