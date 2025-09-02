<?php

declare(strict_types=1);

namespace App\Builders\Products;

use App\Builders\BaseBuilder;
use App\Models\Products\Product;

/**
 * @template TModel of Product
 *
 * @extends BaseBuilder<TModel>
 */
class ProductBuilder extends BaseBuilder {}
