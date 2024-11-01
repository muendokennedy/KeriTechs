<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // protected $guard = [];

    protected $fillable = [
        'productCategory',
        'productName',
        'productSpecifications',
        'productInitialPrice',
        'productDiscountPrice',
        'brandName',
        'productWarranty',
        'productAverageRating',
        'productDescription',
        'productFirstImage',
        'productSecondImage',
        'productThirdImage',
        'productFourthImage'
    ];
}
