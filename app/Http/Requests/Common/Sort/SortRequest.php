<?php

declare(strict_types=1);

namespace App\Http\Requests\Common\Sort;

use App\Enums\Common\Sort\SortDirectionEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class SortRequest extends BaseRequest
{
    public static function rules(): array
    {
        return [
            'sort' => 'sometimes|array',
            'sort.*.fieldName' => 'required_with:s|string|filled',
            'sort.*.direction' => [
                'required_with:s',
                'string',
                Rule::enum(SortDirectionEnum::class),
            ],
        ];
    }
}
