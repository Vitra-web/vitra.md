<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionProduct extends Model
{
    protected $table = 'solution_products';
    protected $guarded = false;

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
    public function getSolutionProductsAttribute($solution) {

        return $this::where('solution_id',$solution->id )->get();
    }

}
