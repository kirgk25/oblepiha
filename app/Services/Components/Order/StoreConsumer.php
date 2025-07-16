<?php

declare(strict_types=1);

namespace App\Services\Components\Order;

use App\Models\Order;
use App\Models\Product;
use App\Services\BaseService;
use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Collection;
use App\Services\OrderService;

class StoreConsumer extends BaseService
{
    public function consume($queueName): ?Order
    {
        $body = $this->messageBrokerService->consume($queueName);
        if (!$body) {
            return null;
        }

        $userId = $body['userId'];
        $bodyOrderProducts = $body['orderProducts'];
        $order = $this->createOrder($userId);
        $productsById = $this->getProductsById($bodyOrderProducts);

        $newOrderProducts = [];
        foreach ($bodyOrderProducts as $bodyOrderProduct) {
            $productId = $bodyOrderProduct['product_id'];
            $product = $productsById[$productId];

            $newOrderProduct = [];
            $newOrderProduct['order_id'] = $order->id;
            $newOrderProduct['product_id'] = $productId;
            $newOrderProduct['quantity'] = $bodyOrderProduct['quantity'];
            $newOrderProduct['amount'] = $bodyOrderProduct['quantity'] * $product->cost;

            $newOrderProducts[$productId] = $newOrderProduct;
            $order->amount += $newOrderProduct['amount'];
        }

        OrderProduct::insert($newOrderProducts);
        $order->save();

        return $order;
    }

    private function createOrder(int $userId): Order
    {
        $tempNumber = md5(rand(0, 100000)) . '-' . rand(0, 100);

        $order = Order::create([
            'user_id' => $userId,
            'status' => OrderService::STATUS_CREATED,
            'number' => $tempNumber,
        ]);

        $order->number = now()->format('ymd') . '-' . $order->id;
        $order->save();

        return $order;
    }

    private function getProductsById(array $bodyOrderProducts): Collection
    {
        $productIds = array_column($bodyOrderProducts, 'product_id');
        return Product::findMany($productIds)->keyBy('id');
    }
}
