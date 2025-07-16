<?php

declare(strict_types=1);

namespace App\Models;

use App\Services\FavouriteService;
use Database\Factories\ProductFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $name
 * @property string $description
 * @property string $cost
 * @property-read Collection|Photo[] $photos
 * @property-read int|null $photos_count
 * @method static ProductFactory factory(...$parameters)
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @mixin Eloquent
 */
class Product extends Model
{
    use HasFactory;

    public const NAME_MAX_LENGTH = 200;
    public const DESCRIPTION_MAX_LENGTH = 1000;

    protected $fillable = [
        'name',
        'description',
        'cost',
    ];

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }

    public function mainPhoto(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->photos->first()->url ?? '',
        );
    }

    public function isFavourite(): Attribute
    {
        return Attribute::make(
            get: fn() => new FavouriteService()->isFavouriteByProduct($this),
        );
    }
}
