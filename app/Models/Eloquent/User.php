<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $primaryKey = 'Id';
    protected $table = 'users';
    protected $fillable = ['Name'];
    public $timestamps = false;

    public function Books()
    {
        return $this->hasMany('App\Models\Eloquent\Book', 'AuthorId', 'Id');
    }
}
