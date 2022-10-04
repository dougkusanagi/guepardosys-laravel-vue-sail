<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'slug' => fake()->slug(),
            'description' => fake()->text(),
            'price' => rand(199, 5487),
            'status' => fake()->randomElement(['active', 'inactive', 'waiting']),
        ];
    }
}

// $table->unsignedBigInteger('category_id');
// $table->string('name');
// $table->string('slug');
// $table->float('price')->default(0);
// $table->string('model')->nullable();
// $table->text('description')->nullable();
// $table->text('description_html')->nullable();
// $table->integer('stock')->default(0);
// $table->integer('stock_local')->default(0);
// $table->integer('stock_local_min')->default(0);
// $table->boolean('active')->default(true);
// $table->string('bar_code')->nullable();
// $table->string('ncm')->nullable();
// $table->float('weight')->default(0);
// $table->float('height')->default(0);
// $table->float('width')->default(0);
// $table->float('length')->default(0);
// $table->string('brand')->nullable();
// $table->integer('availability')->default(0);
// $table->text('keywords')->nullable();
// $table->string('status');
