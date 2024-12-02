<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
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
//        return 'slug' ;
//    }
    public function getStatusTitleAttribute() {
        return self::getStatus()[$this->status];
    }

    public function industry()
    {
        return $this->belongsTo('App\Models\Industry', 'industry_id', 'id');
    }

    public function getProductsNumberAttribute() {
        $productCategories = ProductCategory::where('category_id', $this->id)->get();
        return count($productCategories);
    }

    public function getProductsAttribute() {
        $productSubcategories = ProductCategory::where('category_id',$this->id )->get();
        $products = [];
        foreach ($productSubcategories as $item) {
            $product = Product::where('id', $item->product_id)->first();
            if($product) {
                $products[] = $product;
            }
        }
        return $products;
    }
}
