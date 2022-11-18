<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Favourite
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @method static \Illuminate\Database\Eloquent\Builder|Favourite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favourite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favourite query()
 * @method static \Illuminate\Database\Eloquent\Builder|Favourite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favourite whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favourite whereUserId($value)
 * @mixin \Eloquent
 */
class Favourite extends Model
{
    use HasFactory;
}
