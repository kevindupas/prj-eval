<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
        'label',
        'brand_id'
    ];

    public function brands(){
        return $this->hasMany(Brand::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
