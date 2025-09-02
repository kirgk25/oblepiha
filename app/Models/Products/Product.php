<?php

declare(strict_types=1);

namespace App\Models\Products;

use App\Builders\Products\ProductBuilder;
use App\Models\BaseModel;
use App\Services\Products\FavouriteService;
use Database\Factories\ProductFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
 * @property-read mixed $is_favourite
 * @property-read mixed $main_photo
 * @property-read Collection<int, Photo> $photos
 * @method static ProductBuilder<static>|Product newModelQuery()
 * @method static ProductBuilder<static>|Product newQuery()
 * @method static ProductBuilder<static>|Product query()
 * @mixin Eloquent
 */
class Product extends BaseModel
{
    use HasFactory;

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
            get: fn() => app(FavouriteService::class)->isFavouriteByProduct($this),
        );
    }

    public function newEloquentBuilder($query): ProductBuilder
    {
        return new ProductBuilder($query);
    }
}
