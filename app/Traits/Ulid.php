<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Ulid
{
    protected static function bootUlid()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::ulid();
            }
        });
    }

    public function initializeUlid()
    {
        $this->keyType = 'string';
        $this->incrementing = false;
    }
}
