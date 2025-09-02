<?php

declare(strict_types=1);

namespace App\Http\Requests\Products;

use App\Http\Requests\BaseRequest;
use App\Http\Requests\Common\Sort\SortRequest;

class IndexProductRequest extends BaseRequest
{
    public function rules()
    {
        return [
            ...SortRequest::rules(),
        ];
    }
}
