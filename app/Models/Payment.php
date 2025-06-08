<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Traits\Ulid;

class Payment extends Model
{

    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory, Ulid;

    protected $guarded = ['id', 'created_at'];

    public function order()
    {

        return $this->belongsTo(Order::class);
    }
}
