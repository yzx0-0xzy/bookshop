<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $fillable = ['title', 'description', 'publisher_id', 'name', 'writer', 'price','book_image','subcategory_id'];

}
