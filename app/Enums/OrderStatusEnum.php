<?php

namespace App\Enums;

enum OrderStatusEnum
{
    case Pending;
    case Confirmed;
    case Shipped;
    case Delivered;
    case Canceled;

    public function label(): string
    {
        return match ($this) {
            self::Pending   => 'Pending',
            self::Confirmed => 'Confirmed',
            self::Shipped   => 'Shipped',
            self::Delivered => 'Delivered',
            self::Canceled  => 'Canceled',
        };
    }

    public function value(): string
    {
        return match ($this) {
            self::Pending   => 'pending',
            self::Confirmed => 'confirmed',
            self::Shipped   => 'shipped',
            self::Delivered => 'delivered',
            self::Canceled  => 'canceled',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending   => 'gray',
            self::Confirmed => 'blue',
            self::Shipped   => 'indigo',
            self::Delivered => 'green',
            self::Canceled  => 'red',
        };
    }
}
