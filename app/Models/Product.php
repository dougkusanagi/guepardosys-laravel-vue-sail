<?php

namespace App\Models;

use App\Enums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
	use HasFactory;

	//protected static function boot()
	//{
	//	parent::boot();
	//
	//	static::addGlobalScope('order', function (Builder $builder) {
	//		$builder->orderBy('name', 'asc');
	//	});
	//}

	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class);
	}

	public function productModel(): HasOne
	{
		return $this->hasOne(ProductModel::class);
	}

	public function scopeStatus(Builder $query): Builder
	{
		if (request('status') === null) return $query;
		return $query->where('status', request('status'));
	}

	public function scopeSearch($query)
	{
		return $query->where('name', 'like', request('search') . '%');
	}

	public function scopeFilter($query)
	{
		return $query
			// ->search()
			->when(request('category'), fn ($query, $category_id)  => $query->where('category_id', $category_id))
			->when(request('order_by'), fn ($query, $field) => $query->orderBy($field, request('direction')))
			->status(request('status'));
	}

	public static function getStatusCounts()
	{
		return self::query()
		->selectRaw("count(IF(status = ".ProductStatusEnum::Active.", 1, null)) as totalActive")
		->selectRaw("count(IF(status = ".ProductStatusEnum::Inactive.", 1, null)) as totalInactive")
		->selectRaw("count(IF(status = ".ProductStatusEnum::Waiting.", 1, null)) as totalWaiting")
		->selectRaw("count(*) as total")
		->first();
	}
}
