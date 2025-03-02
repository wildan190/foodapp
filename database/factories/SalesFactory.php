<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Menu;
use App\Models\Sales;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesFactory extends Factory
{
    protected $model = Sales::class;

    public function definition()
    {
        $customer = Customer::inRandomOrder()->first();
        $menus = Menu::inRandomOrder()->take(rand(1, 3))->get(); // Ambil 1-3 menu secara acak

        $order_fee = $this->faker->randomFloat(2, 1, 5); // Biaya order acak
        $total_price = 0;

        foreach ($menus as $menu) {
            $quantity = rand(1, 5); // Jumlah menu acak
            $total_price += $menu->price * $quantity;
        }

        return [
            'customer_id' => $customer->id,
            'order_fee' => $order_fee,
            'total_price' => $total_price + $order_fee, // Tambahkan order_fee ke total_price
        ];
    }
}
