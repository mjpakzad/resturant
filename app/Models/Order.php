<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public const STATUS_REJECTED    = false;
    public const STATUS_APPROVED    = true;

    protected $fillable = [
        'user_id',
        'price',
        'address',
        'status',
    ];

    protected $casts = [
        'status'    => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function foods()
    {
        return $this->hasMany(OrderFood::class);
    }

    public function orderFoods()
    {
        return $this->hasMany(OrderFood::class);
    }
}
