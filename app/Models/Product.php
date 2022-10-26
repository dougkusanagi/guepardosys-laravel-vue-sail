<?php

namespace App\Models;

use App\Enums\ProductStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
	use HasFactory;

	public $perPage = "25";
	protected $guarded = [];
	// protected $fillable = ['category_id'];
	protected $with = ['productModel'];

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
		return $query->where('status', request('status'));
	}

	public function scopeSearch(Builder $query): Builder
	{
		return $query->where('name', 'like', request('search') . '%');
	}

	public function scopeFilter(Builder $query): Builder
	{
		return $query
			->when(request('category'), fn ($query, $category_id)  => $query->where('category_id', $category_id))
			->when(request('order_by'), fn ($query, $field) => $query->orderBy($field, request('direction')))
			->when(request('status') !== null,  fn ($query) => $query->status())
			->when(request('search'), fn ($query) => $query->search());
	}

	public static function getStatusCounts()
	{
		return self::toBase()
			->selectRaw("count(IF(status = " . ProductStatusEnum::Active . ", 1, null)) as totalActive")
			->selectRaw("count(IF(status = " . ProductStatusEnum::Inactive . ", 1, null)) as totalInactive")
			->selectRaw("count(IF(status = " . ProductStatusEnum::Waiting . ", 1, null)) as totalWaiting")
			->selectRaw("count(*) as total")
			->first();
	}
}
