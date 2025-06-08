<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Traits\Ulid;

class OrderItem extends Model
{

    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory, Ulid;

    protected $guarded = ['id', 'created_at'];

    public function order()
    {

        return $this->belongsTo(Order::class);
    }
}
