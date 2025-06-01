<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSlug;
use App\Traits\Ulid;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, HasSlug, Ulid;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    protected static function booted()
    {
        static::created(function ($product) {
            if (empty($product->sku)) {
                $product->sku = self::generateSku($product);
                $product->save();
            }
        });
    }


    public static function generateSku($product)
    {

        $categoryCode = strtoupper(substr($product->subCategory->category->name ?? 'CAT', 0, 3));
        $productCode = strtoupper(substr($product->name, 0, 4));

        return $categoryCode . '-' . $productCode . '-' . uniqid();
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
