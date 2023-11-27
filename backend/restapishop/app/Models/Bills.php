<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    use HasFactory;
    protected $fillable = [
        'vn_pay_code',
        'user_id',
        'product_id',
        'quantity',
        'total_amount',
        'status',
    ];
}
