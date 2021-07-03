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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sort' => function($attribute, $value, $fail) {
                foreach ($value as $field => $direction) {
                    $isFieldError = !in_array($field, [
                        'name',
                        'cost',
                    ]);
                    $isDirectionError = !in_array($direction, [
                        'asc',
                        'desc',
                    ]);

                    if ($isFieldError || $isDirectionError) {
                        $fail(__('content.errors.sort'));
                    }
                }
            }
        ];
    }
}
