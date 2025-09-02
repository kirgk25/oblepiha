<?php

declare(strict_types=1);

namespace App\Models\Orders;

use App\Enums\Orders\OrderStatusEnum;
use App\Enums\VMTR\VMTRElement\VMTRElementSupplyDivisionEnum;
use App\Enums\VMTR\VMTRElement\VMTRElementTypeEnum;
use App\Models\BaseModel;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $number
 * @property int $user_id
 * @property OrderStatusEnum $status
 * @property string $amount
 * @property-read Collection<int, OrderProduct> $orderProducts
 * @method static Builder<static>|Order newModelQuery()
 * @method static Builder<static>|Order newQuery()
 * @method static Builder<static>|Order query()
 * @mixin Eloquent
 */
class Order extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'number',
    ];

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    protected function casts(): array
    {
        return [
            'status' => OrderStatusEnum::class,
        ];
    }
}
