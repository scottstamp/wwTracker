<?php

namespace App;

use Stevebauman\EloquentTable\TableTrait;
use Illuminate\Database\Eloquent\Model;

class FoodCatalog extends Model
{
//    use TableTrait;

    protected $table = "food_catalog";
    protected $guarded = [];
}