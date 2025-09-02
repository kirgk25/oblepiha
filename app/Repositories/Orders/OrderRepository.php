<?php

declare(strict_types=1);

namespace App\Repositories\Orders;

use App\Models\Orders\Order;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @extends BaseRepository<Order>
 */
final class OrderRepository extends BaseRepository
{
    public function getModel(): Order
    {
        return app(Order::class);
    }

    /**
     * @return LengthAwarePaginator<int, User>
     */
    public function index(User $user): LengthAwarePaginator
    {
        return $user
            ->orders()
            ->orderByDesc('id')
            ->with('orderProducts.product')
            ->paginate(config('pagination.max_per_page'));
    }
}
