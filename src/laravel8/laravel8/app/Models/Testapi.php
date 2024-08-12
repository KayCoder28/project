<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class testApi extends Model
{
    //
    protected $table = "testapi";
    protected $fillable = ['title', 'description', 'price', 'availability'];
}
