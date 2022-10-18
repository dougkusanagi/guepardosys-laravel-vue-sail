<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductModel;
use App\Models\ProductModelPrefix;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		// foreach (['pdv', 'mdl', 'ca'] as $prefix) {
		// 	ProductModelPrefix::create(['name' => $prefix]);
		// }

		// $allProductPrefixesIds = ProductModelPrefix::all()->pluck('id');

		// Category::factory(5)
		// 	->has(Product::factory(50)
		// 		->has(ProductModel::factory()->state(
		// 			['product_model_prefix_id' => $allProductPrefixesIds->random()]
		// 		)
		// 			->for(ProductModelPrefix::factory(3))))
		// 	->create();

		// $allCategoryIds = Category::factory(10)->create()->pluck('id');
			// for ($i = 0; $i < 100; $i++) {
			// 	ProductModel::factory()
			// 		->state(['product_model_prefix_id' => $allProductPrefixesIds->random()])
			// 		->for(
			// 			Product::factory()
			// 				// ->forCategory() // forCategory = ->for(Category::factory()->create())
			// 				->state(['category_id' => $allCategoryIds->random()])
			// 				->create()
			// 		)
			// 		->create();
		// }

		// User::factory()->create([
		//   'name' => 'Admin',
		//   'email' => 'admin@email.com',
		// ]);
		// User::factory(9)->create();

		// Seed for production testing purposes
		foreach (['pdv', 'mdl', 'ca'] as $prefix) {
			ProductModelPrefix::create(['name' => $prefix]);
		}

		Category::factory(5)->create();
	}
}
