<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'sort' => 'array:name,cost',
            'sort.name' => 'in:asc,desc',
            'sort.cost' => 'in:asc,desc',
        ];
    }

    public function messages()
    {
        return [
            'sort.*' => __('content.errors.sort'),
        ];
    }
}
