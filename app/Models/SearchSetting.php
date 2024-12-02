<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchSetting extends Model
{
    protected $table = 'search_settings';
    protected $guarded = false;

    public function getProductNameAttribute()
    {
        if($this->item_id) {
            $product = Product::where('id', $this->item_id)->first();
            if($product)  return $product->name_ro;
            else return '';
        } else return '';

    }
    public function getCategoryNameAttribute()
    {
        if($this->item_id && $this->name== 'category') {
            $category = Category::where('id', $this->item_id)->first();
            if($category)  return $category->name_ro;
            else return '';
        } else return '';

    }
    public function getSubcategoryNameAttribute()
    {
        if($this->item_id && $this->name== 'subcategory') {
            $category = Subcategory::where('id', $this->item_id)->first();
            if($category)  return $category->name_ro;
            else return '';
        } else return '';

    }
}
