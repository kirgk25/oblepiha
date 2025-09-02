<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\DTO\Common\Sort\SortDTO;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @see SortRequest
     * @see SortDTO
     */
    public function toSortDTO(): SortDTO
    {
        return SortDTO::from([
            'sort' => $this->validated('sort', []),
        ]);
    }
}
