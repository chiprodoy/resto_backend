<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends MainModel
{
    use HasFactory,useSlug;

    public function textToSlug() : String {
        return $this->title;
    }

}
