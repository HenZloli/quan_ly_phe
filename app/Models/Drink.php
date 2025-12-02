<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    protected $fillable = ['name', 'price'];

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'drink_material')
                    ->withPivot('quantity','unit');
    }
}

