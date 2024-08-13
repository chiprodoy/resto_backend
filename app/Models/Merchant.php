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

            /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
        /**
     * Get the post that owns the comment.
     */

    public function owner()
    {
        return $this->belongsTo(User::class,'id','merchant_owner_id');
    }
            /**
     * Get the comments for the blog post.
     */
    public function meja()
    {
        return $this->hasMany(Meja::class);
    }
}
