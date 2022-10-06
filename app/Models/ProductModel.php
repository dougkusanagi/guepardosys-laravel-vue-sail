<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function prefix() {
        return $this->belongsTo(ProductModelPrefix::class);
    }
}
