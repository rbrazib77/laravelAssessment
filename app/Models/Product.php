<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
use SoftDeletes;

 protected $fillable = ['category_id','name','sku','price','stock_quantity','image','status',];

public function category(){
    return $this->belongsTo(Category::class);
}

public function saleItems(){
    return $this->hasMany(SaleItem::class);
}

}
