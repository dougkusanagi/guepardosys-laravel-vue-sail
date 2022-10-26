<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->loadHelpers();
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Model::shouldBeStrict(!$this->app->isProduction());
	}

	protected function loadHelpers()
	{
		foreach (glob(__DIR__ . '/../Helpers/*.php') as $filename) {
			require_once $filename;
		}
	}
}
