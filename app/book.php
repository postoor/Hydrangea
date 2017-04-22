<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'isbn', 'title', 'author', 'press', 'location', 'owner'
    ];

    protected $hidden = [
        
    ];

    public function Owner(){
        return $this->hasOne('App\User', 'id', 'owner');
    }
}
