<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // create a relationship
    public function user(){

        // a post has a relationship with user and it belongs to user
        return $this->belongsTo('App\User');
        
    }
}
