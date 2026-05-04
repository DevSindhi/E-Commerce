<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class Product extends Model
{
    // protected $table="products";
    // protected $primaryKey="id";

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category'
    ];
}