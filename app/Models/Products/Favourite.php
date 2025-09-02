<?php

declare(strict_types=1);

namespace App\Models\Products;

use App\Models\BaseModel;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Favourite
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @method static Builder<static>|Favourite newModelQuery()
 * @method static Builder<static>|Favourite newQuery()
 * @method static Builder<static>|Favourite query()
 * @mixin Eloquent
 */
class Favourite extends BaseModel
{
    use HasFactory;
}
