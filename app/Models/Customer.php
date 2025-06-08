<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Traits\Ulid;

class Customer extends Model
{
    use Ulid;
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    protected $guarded = ['id', 'updated_at'];


    public function user()
    {

        return $this->belongsTo(User::class);
    }
    public function orders()
    {

        return $this->hasMany(Order::class);
    }
}
