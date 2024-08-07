<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MainModel extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'insert_by', 'update_by','delete_by','user_modify'
    ];

    public function setUuidAttribute($value){
        $this->attributes['uuid'] = (Str::isUuid($value) ? $value : Str::uuid()); //
    }
}

trait UseUserModify{
    public function setUserModifyAttribute($value){
        $this->attributes['user_modify'] = (isset(Auth::user()->name) ? Auth::user()->name : 'bingo'); // Auth::user()->name; //
    }

    public function setUserIdAttribute($value){
        $this->attributes['user_id'] = (empty(Auth::user()->id) ? $value : Auth::user()->id);
    }
}

