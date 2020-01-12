<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'name', 
        'family_name', 
        'other_name',
        'sci_name',
        'suitable_range',
        'water_level',
        'height',
        'root_range',
        'img_trunk',
        'img_blade',
        'img_flower',
        'img_fruit',
        'product_start',
        'product_range',
        'age',
        'comment'
    ];

}
