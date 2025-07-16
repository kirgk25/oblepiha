<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class StoreProductRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:' . Product::NAME_MAX_LENGTH,
            'description' => 'required|string|max:' . Product::DESCRIPTION_MAX_LENGTH,
            'cost' => 'required|numeric|min:0',
            'photos' => 'required|array|max:3',
        ];
    }
}
