<?php

declare(strict_types=1);

namespace App\Http\Requests\Users;

use App\Http\Requests\BaseRequest;
use App\Services\Common\PhoneService;

class StoreTokenRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone' => 'required|regex:' . PhoneService::PHONE_REGEX,
            'code' => 'required|integer|numeric|max:9999',
            'deviceName' => 'required|string|max:50',
        ];
    }
}
