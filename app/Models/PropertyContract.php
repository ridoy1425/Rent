<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyContract extends Model
{
    use HasFactory;

    protected $guarded = ['otherBill'];
    protected $casts = [
        'otherBill'=>'array'
    ];
}
