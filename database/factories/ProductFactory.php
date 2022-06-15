<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'nombre_prod' => $this->faker->sentence,
            'valor' => rand(7,9),
            'fecha_expiracion' => now(),
            'category_id' => rand(1,9)
        ];
    }
}
