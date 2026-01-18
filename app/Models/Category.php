<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'image' ];

    function books(){
        return $this->hasMany(Book::class );
    }
}
