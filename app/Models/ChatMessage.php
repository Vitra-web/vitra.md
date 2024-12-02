<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $table = 'chat_messages';
    protected $guarded = false;

    public function chat()
    {
        return $this->belongsTo('App\Models\Chat', 'chat_id', 'id');
    }
}
