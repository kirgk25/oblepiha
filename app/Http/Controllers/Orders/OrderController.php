<?php

declare(strict_types=1);

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\StoreOrderRequest;
use App\Http\Resources\Orders\Index\IndexOrderCollection;
use App\Http\Resources\Orders\StoreOrderResource;
use App\Services\Orders\OrderService;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function __construct(
        private OrderService $orderService,
    ) {}

    public function index(): IndexOrderCollection
    {
        return IndexOrderCollection::make($this->orderService->index());
    }

    public function store(StoreOrderRequest $request): Response
    {
        $orderProducts = $request->validated('orderProducts');
        $this->orderService->store($orderProducts);
        return response()->noContent();
    }

    public function consumeStore(): StoreOrderResource
    {
        $order = $this->orderService->consumeStore();

        if (null !== $order) {
            return StoreOrderResource::make($order);
        }
    }
}
