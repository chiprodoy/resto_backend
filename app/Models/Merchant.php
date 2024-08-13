<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Merchant extends MainModel
{
    use HasFactory;

    public function setSlugAttribute($value){
        $this->attributes['slug'] = Str::slug('merchant_name');
    }
}
