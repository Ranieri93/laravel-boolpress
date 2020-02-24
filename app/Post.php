<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'author', 'content', 'slug', 'category_id'];
    //qui creo una funzione che mi specifichi
    // l'appartenenza del singolo post alla categoria

    public function category() {
        return $this->belongsTo('App\Category');
    }
}
