<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = false;


    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 0;

    static function getStatus() {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_NOT_ACTIVE => 'Not active',
        ];
    }

    public function getStatusTitleAttribute() {
        return self::getStatus()[$this->status];
    }

//    public function getRouteKeyName()
//    {
//        return 'slug' ;
//    }

    public function industry()
    {
        return $this->belongsTo('App\Models\Industry', 'industry_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'category_id', 'id');
    }
    public function subcategory()
    {
        return $this->belongsTo('App\Models\Subcategory', 'subcategory_id', 'id');
    }
    public function productImages()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\ProductCategory', 'product_categories', 'product_id', 'category_id');
    }
    public function subcategories()
    {
        return $this->belongsToMany('App\Models\ProductSubCategory', 'product_subcategories', 'product_id', 'subcategory_id');
    }

    public function similarProducts()
    {
        return $this->belongsToMany('App\Models\SimilarProduct', 'similar_products', 'product_id', 'similar_product_id');
    }

    public function productCategories()
    {
        return $this->hasMany('App\Models\ProductCategory');
    }

    public function productSubcategories()
    {
        return $this->hasMany('App\Models\ProductSubCategory');
    }

    public function productWidth()
    {
        return $this->hasMany('App\Models\ProductWidth');
    }

    public function productHeight()
    {
        return $this->hasMany('App\Models\ProductHeight');
    }
    public function productDeep()
    {
        return $this->hasMany('App\Models\ProductDeep');
    }

    public function productColor()
    {
        return $this->hasMany('App\Models\ProductColor');
    }

    public function productType()
    {
        return $this->hasMany('App\Models\ProductType');
    }

    public function productMontants()
    {
        return $this->hasMany('App\Models\ProductMontant');
    }

    public function productTraversDeeps()
    {
        return $this->hasMany('App\Models\ProductTraversDeep');
    }
    public function productTraversWidth()
    {
        return $this->hasMany('App\Models\ProductTraversWidth');
    }
    public function productShelves()
    {
        return $this->hasMany('App\Models\ProductShelve');
    }
    public function productPdfs()
    {
        return $this->hasMany('App\Models\ProductPdf');
    }
    public function getProductVariantsAttribute()
    {
        return ProductVariant::where('product_id', $this->id)->get()->toArray();

    }
    public function getProductSpecificationsAttribute()
    {
        return ProductSpecification::where('product_id', $this->id)->get()->toArray();

    }

    public function constructorTrolley()
    {
        return $this->hasOne('App\Models\ConstructorTrolley');
    }
    public function constructor()
    {
        return $this->belongsTo('App\Models\Constructor', 'constructor_id', 'id');
    }

    public function constructorBasket()
    {
        return $this->hasOne('App\Models\ConstructorBasket');
    }

    public function getProductDimensionVariantsAttribute()
    {
        $productVariant = ProductVariant::where('product_id', $this->id)->get()->toArray();
        if($productVariant) {
            return $productVariant;
        } else return '';


    }

    public function getCategoryNamesAttribute()
    {
       $productCategories = ProductCategory::where('product_id', $this->id)->get();
        $nameArr = [];
        foreach ($productCategories as $item) {
            $category = Category::where('id', $item->category_id)->first();
            if(isset($category) && isset($category->name_ro)) {
                $nameArr[]=$category->name_ro;
            }

        }

        return implode(', ', $nameArr);
    }

    public function getSubcategoryNamesAttribute()
    {
        $productSubCategories = ProductSubCategory::where('product_id', $this->id)->get();
        $nameArr = [];
        foreach ($productSubCategories as $item) {
            $category = Subcategory::where('id', $item->subcategory_id)->first();
            if(isset($category) && isset($category->name_ro)) {
                $nameArr[]=$category->name_ro;
            }

        }

        return implode(', ', $nameArr);
    }
    public function getCategoryIdAttribute()
    {
        $productCategories = ProductCategory::where('product_id', $this->id)->get();
        if(count($productCategories)>0) {
            foreach ($productCategories as $item) {
                $category = Category::where('id', $item->category_id)->first();
                if($category) {
                    return $category->slug;
                } else return '';

            }
        } else return '';

    }

    public function getSubcategoryIdAttribute()
    {
        $productSubCategories = ProductSubCategory::where('product_id', $this->id)->get();
        if(count($productSubCategories)>0) {
            foreach ($productSubCategories as $item) {
                $subcategory = Subcategory::where('id', $item->subcategory_id)->first();
                if($subcategory) {
                    return $subcategory->slug;
                } else return 'none';

            }
        } else return 'none';

    }
}
