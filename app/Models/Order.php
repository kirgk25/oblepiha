<?php

declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
 * @property int $status
 * @property string $amount
 * @property-read Collection|OrderProduct[] $orderProducts
 * @property-read int|null $order_products_count
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @mixin Eloquent
 */
class Order extends Model
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
}
