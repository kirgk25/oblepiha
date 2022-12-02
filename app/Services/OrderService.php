<?php namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService extends BaseService
{
    const STATUS_CREATED = 1;
    const STATUS_ASSEMBLE = 2;
    const STATUS_EN_ROUTE = 3;
    const STATUS_WAIT = 4;
    const STATUS_DELIVERED = 5;
    const STATUS_CANCELLED = 6;

    public function index(): LengthAwarePaginator
    {
        $orders = $this->getUser()
            ->orders()
            ->orderByDesc('id')
            ->with('orderProducts.product')
            ->paginate(2);

        return $orders;
    }

    public function store(): Order
    {
        $request = request();

        $order = $this->createOrder();
        $productsById = $this->getProductsById($request);

        $newOrderProducts = [];
        foreach ($request->orderProducts as $requestOrderProduct) {
            $productId = $requestOrderProduct['product_id'];
            $product = $productsById[$productId];

            $newOrderProduct = [];
            $newOrderProduct['order_id'] = $order->id;
            $newOrderProduct['product_id'] = $productId;
            $newOrderProduct['quantity'] = $requestOrderProduct['quantity'];
            $newOrderProduct['amount'] = $requestOrderProduct['quantity'] * $product->cost;

            $newOrderProducts[$productId] = $newOrderProduct;
            $order->amount += $newOrderProduct['amount'];
        }

        OrderProduct::insert($newOrderProducts);
        $order->save();

        return $order;
    }

    private function createOrder(): Order
    {
        $userId = $this->getUserId();
        $tempNumber = md5(rand(0,100000)) . '-' . rand(0,100);

        $order = Order::create([
            'user_id' => $userId,
            'status' => self::STATUS_CREATED,
            'number' => $tempNumber
        ]);

        $order->number = now()->format('ymd') . '-' . $order->id;
        $order->save();

        return $order;
    }

    private function getProductsById(Request $request): Collection
    {
        $productIds = array_column($request->orderProducts, 'product_id');
        return Product::findMany($productIds)->keyBy('id');
    }
}
