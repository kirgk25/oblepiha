<?php

namespace App\Models;

use Database\Factories\PhotoFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Photo
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $product_id
 * @property string $url
 * @method static PhotoFactory factory(...$parameters)
 * @method static Builder|Photo newModelQuery()
 * @method static Builder|Photo newQuery()
 * @method static Builder|Photo query()
 * @mixin Eloquent
 */
class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
    ];

    protected $visible = [
        'id',
        'url',
    ];
}
