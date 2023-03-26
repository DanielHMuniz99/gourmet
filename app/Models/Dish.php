<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    public $timestamps = false;

    protected $table = "dishes";

    protected $fillable = [
        'name',
        'parent_id',
    ];
}
