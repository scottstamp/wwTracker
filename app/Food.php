<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'food';
    protected $guarded = [];
    //protected $fillable = ['user_id', 'name', 'calories', 'sugar', 'saturated_fat', 'protein', 'points', 'eaten_at', 'created_at', 'updated_at'];
}
