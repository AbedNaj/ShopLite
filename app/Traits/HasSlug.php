<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::creating(function ($model) {
            $model->slug = self::generateUniqueSlug($model, $model->slugSource ?? 'name');
        });
    }

    protected static function generateUniqueSlug($model, $field): string
    {
        $baseSlug = Str::slug($model->{$field}, '-', null);
        if (empty($baseSlug)) {
            $baseSlug = Str::random(8);
        }

        $slug = $baseSlug;
        $count = 1;

        while ($model::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }

        return $slug;
    }
}
