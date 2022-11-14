<?php

namespace App\Http\Requests;

use App\Services\PhoneService;
use Illuminate\Foundation\Http\FormRequest;

class StoreTokenRequest extends FormRequest
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
            'phone' => 'required|regex:' . PhoneService::PHONE_REGEX,
            'code' => 'required|integer|numeric|max:9999',
            'deviceName' => 'required|string|max:50',
        ];
    }
}
