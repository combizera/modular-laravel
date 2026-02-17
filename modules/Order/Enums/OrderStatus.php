<?php

namespace Modules\Order\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public static function labels(): array
    {
        return [
            self::PENDING->value    => 'Pending',
            self::COMPLETED->value  => 'Completed',
            self::CANCELLED->value  => 'Cancelled',
        ];
    }
}
