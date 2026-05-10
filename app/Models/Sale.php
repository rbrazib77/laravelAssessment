<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
use SoftDeletes;
protected $fillable = ['invoice_id','customer_id','total','discount','grand_total',];

public function customer(){
    return $this->belongsTo(Customer::class);
}

public function saleItems(){
    return $this->hasMany(SaleItem::class);
}

}
