<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends MainModel
{
    use HasFactory;
    /**
     * Get the post that owns the comment.
     */
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}
