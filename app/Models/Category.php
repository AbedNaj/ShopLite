<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSlug;
use App\Traits\Ulid;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory, Ulid, HasSlug;

    protected $fillable = [
        'id',
        'name',
        'description',
        'image',
    ];
    protected string $slugSource = 'name';

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    public function subCategory()
    {
        return $this->hasMany(SubCategory::class);
    }
}
