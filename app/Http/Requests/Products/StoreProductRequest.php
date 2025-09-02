<?php

declare(strict_types=1);

namespace App\Http\Requests\Products;

use App\Http\Requests\BaseRequest;
use App\Services\Products\ProductService;

class StoreProductRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:' . ProductService::NAME_MAX_LENGTH,
            'description' => 'required|string|max:' . ProductService::DESCRIPTION_MAX_LENGTH,
            'cost' => 'required|numeric|min:0',
            'photos' => 'required|array|max:3',
        ];
    }
}
