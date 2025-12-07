<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class AccManager extends Authenticatable
{
    protected $table = 'acc_manager';

    protected $fillable = [
        'username',
        'password',
        'role',
    ];


    protected $hidden = [
        'password',
    ];
}
