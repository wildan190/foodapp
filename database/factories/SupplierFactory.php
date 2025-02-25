<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company, // Nama supplier menggunakan nama perusahaan
            'email' => $this->faker->unique()->companyEmail, // Email unik
            'phone_number' => $this->faker->unique()->phoneNumber, // Nomor telepon unik
            'address' => $this->faker->address, // Alamat acak
        ];
    }
}
