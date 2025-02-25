<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_id',
        'transaction_number',
        'transaction_date',
        'invoice_number',
    ];

    public function sales()
    {
        return $this->belongsTo(Sales::class);
    }
}
