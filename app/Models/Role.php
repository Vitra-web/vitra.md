<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $guarded = false;

    public function getUsersNumberAttribute() {

        $users=User::where('role_id', $this->id)->get();

        return count($users);

    }
}
