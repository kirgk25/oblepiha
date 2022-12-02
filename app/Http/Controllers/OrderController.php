<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\StoreOrderResource;
use App\Http\Resources\Order\Index\IndexOrderCollection;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(
        private OrderService $orderService,
    ) {}

    public function index()
    {
        return new IndexOrderCollection($this->orderService->index());
    }

    public function store(StoreOrderRequest $request)
    {
        return new StoreOrderResource($this->orderService->store());
    }
}
