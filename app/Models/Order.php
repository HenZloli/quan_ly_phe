<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'drink_id',
        'quantity',
        'price',
        'status',
    ];

    public function drink()
    {
        return $this->belongsTo(Drink::class);
    }

    public function user()
    {
        return $this->belongsTo(AccManager::class);
    }
}
