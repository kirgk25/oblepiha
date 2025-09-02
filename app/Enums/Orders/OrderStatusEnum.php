<?php

declare(strict_types=1);

namespace App\Enums\Orders;

enum OrderStatusEnum: int
{
    case Created = 1;
    case Assemble = 2;
    case EnRoute = 3;
    case Wait = 4;
    case Delivered = 5;
    case Cancelled = 6;
}
