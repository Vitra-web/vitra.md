<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryProduct extends Model
{
    protected $table = 'industry_products';
    protected $guarded = false;

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
}