<?php

declare(strict_types=1);

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
 * @method static PhotoFactory factory($count = null, $state = [])
 * @method static Builder<static>|Photo newModelQuery()
 * @method static Builder<static>|Photo newQuery()
 * @method static Builder<static>|Photo query()
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
