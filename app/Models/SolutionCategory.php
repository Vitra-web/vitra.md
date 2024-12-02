<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionCategory extends Model
{
    protected $table = 'solution_categories';
    protected $guarded = false;

    public function industry()
    {
        return $this->belongsTo('App\Models\Industry', 'industry_id', 'id');
    }
    public function products() {

        return $this->hasMany('App\Models\SolutionProduct', 'solution_id', 'id');
    }

    public function solutions() {

        return $this->hasMany('App\Models\Solution', 'category_id', 'id');
    }
}
