<?php

declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Favourite
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @method static Builder|Favourite newModelQuery()
 * @method static Builder|Favourite newQuery()
 * @method static Builder|Favourite query()
 * @mixin Eloquent
 */
class Favourite extends Model
{
    use HasFactory;
}
