<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryIdea extends Model
{
    protected $table = 'category_ideas';
    protected $guarded = false;

    public function industry()
    {
        return $this->belongsTo('App\Models\Industry', 'industry_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\CategoryIdeaProduct', 'category_idea_products', 'category_idea_id', 'product_id');
    }
}
