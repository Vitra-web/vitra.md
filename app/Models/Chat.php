<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';
    protected $guarded = false;

    const STATUS_NEW = 0;
    const STATUS_VIEW = 1;
    const STATUS_ANSWERED = 2;


    static function getStatus() {
        return [
            self::STATUS_NEW => trans('panel.status_new'),
            self::STATUS_VIEW => trans('panel.status_view'),
            self::STATUS_ANSWERED => trans('panel.status_answered'),

        ];
    }

    public function getStatusTitleAttribute() {
        return self::getStatus()[$this->checked];
    }

    public function industry()
    {
        return $this->belongsTo('App\Models\Industry', 'industry_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\ChatMessage');
    }


}
