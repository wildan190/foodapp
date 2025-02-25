<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'order_fee',
        'total_price'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function salesDetails()
    {
        return $this->hasMany(SalesDetail::class);
    }
}
