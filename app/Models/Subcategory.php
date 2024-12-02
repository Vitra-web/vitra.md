<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategories';
    protected $guarded = false;


    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 0;

    static function getStatus() {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_NOT_ACTIVE => 'Not active',
        ];
    }

//    public function getRouteKeyName()
//    {
//        return 'slug';
//    }
    public function getStatusTitleAttribute() {
        return self::getStatus()[$this->status];
    }

    public function industry()
    {
        return $this->belongsTo('App\Models\Industry', 'industry_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
    public function specification()
    {
        return $this->hasOne('App\Models\SubcategorySpecification', 'subcategory_id', 'id');
    }
    public function getHurakanCategoryNumberAttribute() {
        if($this->hurakan_category1 && $this->hurakan_category2 && $this->hurakan_category3 && $this->hurakan_category4 && $this->hurakan_category5) {
            return '5';
        } elseif($this->hurakan_category1 && $this->hurakan_category2 && $this->hurakan_category3 && $this->hurakan_category4 ) {
            return '4';
        } elseif($this->hurakan_category1 && $this->hurakan_category2 && $this->hurakan_category3  ) {
            return '3';
        } elseif($this->hurakan_category1 && $this->hurakan_category2  ) {
            return '2';
        } elseif($this->hurakan_category1  ) {
            return '1';
        } else return '0';
    }
    public function getProductsNumberAttribute() {
        $productSubcategories = ProductSubCategory::where('subcategory_id', $this->id)->get();
        return count($productSubcategories);
    }

}
