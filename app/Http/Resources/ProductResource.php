<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'slug'            => $this->slug,
            'description'     => $this->description,
            'sku'             => $this->sku,
            'price'           => $this->price,
            'discount_price'  => $this->discount_price,
            'stock'           => $this->stock,
            'status'          => $this->status,
            'sub_category_id' => $this->sub_category_id,
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at,
            'images' => $this->images->map(fn($image) => [
                'id' => $image->id,
                'image_path' => $image->image_path,
                'is_primary' => $image->is_primary,
                'order' => $image->order,
            ]),
        ];
    }
}
