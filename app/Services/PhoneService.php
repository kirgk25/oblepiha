<?php namespace App\Services;

class PhoneService extends BaseService
{
    public const PHONE_REGEX = '/^7\d{10}$/';

    public function sendMessage(int $phone, string $message): void
    {
        // TODO add logic for sending code to phone
    }
}
