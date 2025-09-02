<?php

declare(strict_types=1);

namespace App\Http\Requests\Orders;

use App\Http\Requests\BaseRequest;

class StoreOrderRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'orderProducts' => 'required|array|min:1|max:15',
            'orderProducts.*.product_id' => 'required|exists:products,id',
            'orderProducts.*.quantity' => 'required|min:1|max:100',
        ];
    }
}
