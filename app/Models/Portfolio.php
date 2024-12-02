<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'portfolios';
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

    public function industry()
    {
        return $this->belongsTo('App\Models\Industry', 'industry_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\PortfolioCategory', 'category_id', 'id');
    }
}

