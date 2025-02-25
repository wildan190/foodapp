<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'menu_name', 'stock', 'price', 'supplier_id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
