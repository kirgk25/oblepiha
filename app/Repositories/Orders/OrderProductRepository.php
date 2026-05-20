<?php

declare(strict_types=1);

namespace App\Repositories\Orders;

use App\Models\Orders\OrderProduct;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<OrderProduct>
 */
final class OrderProductRepository extends BaseRepository
{
    public function getModel(): OrderProduct
    {
        return app(OrderProduct::class);
    }
}
