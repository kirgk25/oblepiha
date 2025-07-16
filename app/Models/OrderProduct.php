<?php

declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\OrderProduct
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $quantity
 * @property string $amount
 * @property-read Product|null $product
 * @method static Builder|OrderProduct newModelQuery()
 * @method static Builder|OrderProduct newQuery()
 * @method static Builder|OrderProduct query()
 * @mixin Eloquent
 */
class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'amount',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
