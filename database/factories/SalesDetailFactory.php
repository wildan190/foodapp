<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Sales;
use App\Models\SalesDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesDetailFactory extends Factory
{
    protected $model = SalesDetail::class;

    public function definition()
    {
        $sale = Sales::inRandomOrder()->first();
        $menu = Menu::inRandomOrder()->first();
        $quantity = rand(1, 5);

        return [
            'sales_id' => $sale->id,
            'menu_id' => $menu->id,
            'quantity' => $quantity,
            'price' => $menu->price, // Simpan harga satuan menu
        ];
    }
}
