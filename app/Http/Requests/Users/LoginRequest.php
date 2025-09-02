<?php

declare(strict_types=1);

namespace App\Http\Requests\Users;

use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone' => 'required|regex:/^7\d{10}$/',
        ];
    }
}
