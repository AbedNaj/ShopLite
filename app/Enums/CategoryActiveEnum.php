<?php

namespace App\Enums;

enum CategoryActiveEnum: int
{

    case ACTIVE = 1;
    case INACTIVE = 0;

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
        };
    }

    public function value(): int
    {
        return match ($this) {
            self::ACTIVE => 1,
            self::INACTIVE => 0,
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::ACTIVE => 'green',
            self::INACTIVE => 'red',
        };
    }
    public function isActive(): bool
    {
        return $this === self::ACTIVE;
    }
}
