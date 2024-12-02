<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstructorTrolley extends Model
{
    protected $table = 'constructor_trolleys';
    protected $guarded = false;

    public function wheels()
    {
        return $this->belongsToMany('App\Models\WheelConstructorTrolley', 'wheel_constructor_trolleys', 'constructor_trolley_id', 'wheel_id');
    }
}
