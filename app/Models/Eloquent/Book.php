<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $primaryKey = 'Id';
    protected $table = 'books';
    protected $fillable = ['Name'];

    public function Author()
    {
        return $this->belongsTo('App\Models\Eloquent\User', 'AuthorId', 'Id');
    }
}
