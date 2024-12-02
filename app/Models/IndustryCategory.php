<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryCategory extends Model
{
    protected $table = 'industry_categories';
    protected $guarded = false;

    public function industry()
    {
        return $this->belongsTo('App\Models\Industry', 'industry_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\IndustryProduct', 'industry_products', 'industry_category_id', 'product_id');
    }
}
