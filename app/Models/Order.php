<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Traits\Ulid;

class Order extends Model
{
    use Ulid;
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $guarded = ['id', 'created_at'];


    public function items()
    {

        return $this->hasMany(OrderItem::class);
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function payments()
    {

        return $this->hasMany(Payment::class);
    }
}
