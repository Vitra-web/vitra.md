<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WheelConstructorTrolley extends Model
{
    protected $table = 'wheel_constructor_trolleys';
    protected $guarded = false;
    public function wheels()
    {
        return $this->belongsTo('App\Models\Wheels', 'wheel_id', 'id');
    }
}
