<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    protected $model = Menu::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->unique()->lexify('MENU-?????')),
            'menu_name' => $this->faker->word,
            'stock' => $this->faker->numberBetween(10, 100),
            'price' => $this->faker->randomFloat(2, 5, 50),
            'supplier_id' => Supplier::inRandomOrder()->first()->id ?? Supplier::factory(),
        ];
    }
}
