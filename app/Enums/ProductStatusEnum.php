<?php

namespace App\Enums;

enum ProductStatusEnum
{

    case Active;
    case Inactive;
    case Draft;

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Active',
            self::Inactive => 'Inactive',
            self::Draft => 'Draft',
        };
    }

    public function value(): string
    {
        return match ($this) {
            self::Active => 'active',
            self::Inactive => 'inactive',
            self::Draft => 'draft',
        };
    }
    public function color(): string
    {
        return match ($this) {
            self::Active => 'green',
            self::Inactive => 'red',
            self::Draft => 'yellow',
        };
    }
}
