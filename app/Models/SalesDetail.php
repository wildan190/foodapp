<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_id',
        'menu_id',
        'quantity',
        'price'
    ];

    public function sales()
    {
        return $this->belongsTo(Sales::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
