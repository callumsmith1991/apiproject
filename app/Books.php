<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $fillable = ['ISBN', 'title', 'author', 'category', 'price'];
    protected $attributes = ['category' => ''];
}
