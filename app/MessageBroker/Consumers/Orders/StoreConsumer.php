<?php

declare(strict_types=1);

namespace App\MessageBroker\Consumers\Orders;

use App\Enums\Common\MessageBroker\MessageBrokerQueueEnum;
use App\Enums\Orders\OrderStatusEnum;
use App\MessageBroker\Consumers\BaseConsumer;
use App\Models\Orders\Order;
use App\Models\Products\Product;
use App\Models\Orders\OrderProduct;
use Illuminate\Database\Eloquent\Collection;

class StoreConsumer extends BaseConsumer
{
    public function consume(): ?Order
    {
        $body = $this->messageBroker->consume(MessageBrokerQueueEnum::OrdersStore->value);
        if (empty($body)) {
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
            'status' => OrderStatusEnum::Created,
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
